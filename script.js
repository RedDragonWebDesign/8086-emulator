"use strict";

class Assembler8086 {
	assembly = '';
	compactAssembly = '';
	listing = '';
	binaryMap = {
		'name': '',
		'org': '',
		'mov ax': 'B8',
		'mov bx': 'BB',
		'mov cx': 'B9',
		'mov ds': '8E',
		'mov di': 'BF',
		'mov [': 'C6',
		'int': 'CD',
		'add': '83',
		'loop': 'E2',
		'ret': 'C3',
	}
	// Syntaxes: [], '', "", 11, 11h, 11b
	// name, org
	// label:
	
	setAssembly(s) {
		this.assembly = s;
	}
	
	getListing() {
		this.listing = this.getCompactAssembly();
		
		
		
		return this.listing;
	}
	
	getCompactAssembly() {
		this.compactAssembly = this.assembly;
		this.compactAssembly = this._deleteAssemblyComments(this.compactAssembly);
		this.compactAssembly = this._putLabelsOnOwnLine(this.compactAssembly);
		this.compactAssembly = this._condenseWhitespace(this.compactAssembly);
		this.compactAssembly = this._trimEveryLine(this.compactAssembly);
		this.compactAssembly = this._deleteEmptyLines(this.compactAssembly);
		return this.compactAssembly;
	}
	
	_putLabelsOnOwnLine(s) {
		return s.replace(/^(.*:)(.*)$/gm, '$1\n$2');
	}
	
	/** Turns all whitespace, such as two spaces, tab, etc., into a single space. */
	_condenseWhitespace(s) {
		return s.replace(/[^\S\r\n]+/g, ' ');
	}
	
	_trimEveryLine(s) {
		return s.split("\n").map(v => v.trim()).join("\n");
	}
	
	_deleteAssemblyComments(s) {
		return s.replace(/;.*$/gm, '');
	}
	
	_deleteEmptyLines(s) {
		let lastS = '';
		while ( s != lastS ) {
			lastS = s;
			s = s.replace(/\r?\n\r?\n/g, "\n");
		}
		return s;
	}
}

class Binary {
	byteArray = []; // array of bytes containing ints. Example: FF A0 = [255, 160]
	
	setByteArray(byteArray) {
		this.byteArray = byteArray;
	}
	
	getHexString() {
		return this.byteArrayToHex(this.byteArray, ' ');
	}
	
	/** @param array with ints ranging 0-255, that represent the byte */
	byteArrayToHex(byteArray, inBetweenChar = '', fixEndian = false) {
		let hex = byteArray.map(v => this.padLeft(this.intToHex(v), 2, '0')).join('');
		
		// Little endian applies to hexadecimal offsets & addresses, too. Only leave in big endian if you're going to print a bunch of binary as hex, without doing any interpretation.
		if ( fixEndian ) {
			hex = this.hexLittleEndianToBigEndian(hex);
		}
		
		hex = this.addCharToStringEveryXSpots(hex, inBetweenChar, 2);
		
		return hex;
	}
	
	intToHex(int) {
		return int.toString(16).toUpperCase();
	}
	
	padLeft(string, totalLength, charToAdd) {
		if ( string.length > totalLength ) {
			return string.slice(0, totalLength);
		}
		let numberOfChars = totalLength - string.length;
		return charToAdd.repeat(numberOfChars) + string;
	}
	
	/** Quick guide to Endian.
		
		Little endian = bytes backwards from normal reading order
		Big endian = bytes normal reading order
		
		x86 processors = little endian
		
		KEEP AS LITTLE ENDIAN
		- binary in hex editor
		- strings
		- arrays
		
		CONVERT TO BIG ENDIAN FOR EASY READING
		- memory offsets, memory addresses
		- numbers
	*/
	hexLittleEndianToBigEndian(hex) {
		if ( hex.length > 2 ) {
			let hexArray = hex.replace(/[^A-Za-z0-9]/, '').split('');
			console.log(hexArray);
			let hexBuffer = '';
			let charBuffer = '';
			for ( let value of hexArray ) {
				if ( charBuffer ) {
					hexBuffer = charBuffer + value + hexBuffer;
					charBuffer = '';
				} else {
					charBuffer = value;
				}
			}
			return hexBuffer;
		} else {
			return hex;
		}
	}
	
	// https://stackoverflow.com/a/2712896/3480193
	addCharToStringEveryXSpots(str, char, offset) {
		if ( ! char ) {
			return str;
		}
		
		let regExPattern = new RegExp('(.{' + offset + '})', 'g');
		
		return str.replace(regExPattern, '$1' + char);
	};
}

function loadBinaryResource(url) {
	var byteArray = [];
	var req = new XMLHttpRequest();
	req.open('GET', url, false);
	req.overrideMimeType('text\/plain; charset=x-user-defined');
	req.send(null);
	if (req.status != 200) return byteArray;
	for (var i = 0; i < req.responseText.length; ++i) {
		byteArray.push(req.responseText.charCodeAt(i) & 0xff)
	}
	return byteArray;
}

function loadStringResource(url) {
	try {
		let xmlhttp = new XMLHttpRequest();
		xmlhttp.open('GET', url, false);
		xmlhttp.send();
		return xmlhttp.responseText;
	} catch(DOMException) {
		return "CORS policy error. The website we are trying to fetch these filters from is not allowing our script to access it.";
	}
}

window.addEventListener('DOMContentLoaded', (e) => {
	// textareas
	let assembly = document.getElementById('assembly');
	let listing = document.getElementById('listing');
	// buttons
	let assemble = document.getElementById('assemble');
	
	let assembler = new Assembler8086();
	
	assembly.value = loadStringResource('./asm/hello-world.asm');
	
	assemble.addEventListener('click', (e) => {
		assembler.setAssembly(assembly.value);
		
		listing.value = assembler.getCompactAssembly();
	});
});