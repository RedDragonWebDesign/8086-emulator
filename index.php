<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8" />
		<title>8086 Emulator</title>
		<link rel="stylesheet" href="style.css" />
		<script type="module" src="script.js"></script>
	</head>
	<body>
		<h1>
			8086 Emulator
		</h1>
		<p>
			We're going to start simple. This emulator just does COM files and the Opcodes needed to run "Hello World" (mov, int, add, loop, ret) . I'll add more once that is working.
		</p>
		<p>
			<strong>8086 Assembly:</strong><br />
			<select>
				<option>Test</option>
			</select>
			<textarea id="assembly" class="important"></textarea><br />
			<button id="assemble">Assemble</button>
			<button>Load</button>
			<button>Save As</button>
		</p>
		<p>
			<strong>Listing:</strong><br />
			<textarea id="listing" class="small"></textarea>
		</p>
		<p>
			<strong>Assembler Warnings:</strong><br />
			<textarea id="warnings" class="small"></textarea>
		</p>
		<p>
			<strong>Binary:</strong><br />
			<select>
				<option>Test</option>
			</select>
			<textarea id="binary" class="important"></textarea><br />
			<button>Emulate</button>
			<button>Load</button>
			<button>Save As</button>
		</p>
		<p>
			<strong>Memory:</strong><br />
			<span class="stack">Stack</span>
			<span class="heap">Heap</span>
			<span class="bios">BIOS</span>
			<span class="dos">DOS</span>
			<span class="this-application">This Application</span>
			<span class="unallocated">Unallocated</span><br />
			<textarea id="memory" class="small"></textarea>
		</p>
		<p>
			<strong>Emulator Important Variables:</strong><br />
			<textarea id="variables" class="small">
entry point=CS:IP
stack pointer=SS:SP
variable pointer = DS:EA (effective address)
string source = DS:SI
string destination = ES:DI
BP used as base register = SS:EA (effective address)
			
Actual File Size=

Actual Non Header File Size=
Computed Non Header File Size=((wPageCnt*512)-(wHdrSize*16))-wPartPage

Actual Checksum=
Header Checksum=

PSP Address=
file offset of load module = (wHdrSize * 16)
START_SEG = PSP+10H
relocation table = [modified relocation table here]
program_memory_start = 
program_memory_end = 

Also set the registers...
ES = DS = PSP
Set AX to indicate the validity of drive IDs in command line
SS = START_SEG+ReloSS
SP = ExeSP
CS = START_SEG+ReloCS
IP = ExeIP

Detect It Easy 3.0 has a nice file map.
[offset] [description]
- 0000 MS DOS Header
- not packed
- 18540 packed
- 29170 overlay

Keyboard Buffer = 
			</textarea>
		</p>
		<p>
			<strong>Registers:</strong><br />
			<textarea id="registers" class="small"></textarea>
		</p>
		<p>
			<button id="step">Step</button>
			<button id="run">Run</button>
		</p>
		<p>
			<strong>Console:</strong><br />
			<textarea id="console" class="important"></textarea>
		</p>
		
		<p>
			<strong>We support...</strong>
			<ul>
				<li>
					Opcodes
					<ul>
						<li>mov</li>
						<li>int</li>
						<li>add</li>
						<li>loop</li>
						<li>ret</li>
					</ul>						
				</li>
				<li>
					Interrupts (int)
					<ul>
						<li>
							<a href="http://www.ctyme.com/intr/rb-0069.htm">
								Int 10/AH=00h - VIDEO - SET VIDEO MODE
							</a>
						</li>
						<li>
							<a href="http://www.ctyme.com/intr/rb-0117.htm">
								Int 10/AX=1003h - VIDEO - TOGGLE INTENSITY/BLINKING BIT (Jr, PS, TANDY 1000, EGA, VGA)
							</a>
						</li>
						<li>
							<a href="http://www.ctyme.com/intr/rb-1754.htm">
								Int 16/AH=00h - KEYBOARD - GET KEYSTROKE
							</a>
						</li>
					</ul>
				</li>
				<li>
					Memory Addresses
					<ul>
						<li>
							<a href="http://muruganad.com/8086/8086-Assembly-Writing-Directly-to-Video-Memory-B800.html">
								b8000 - Text Buffer
							</a>
							<!-- a0000 - Video Graphics Buffer -->
						</li>
					</ul>
				</li>
				<li>
					I/O Ports (out)
				</li>
			</ul>
		</p>
		
		<p>
			<strong>Tips:</strong>
		</p>
		<p>
			Writing an assembler or emulator without a teacher/professor/class can have a large learning curve. It took me a couple of weeks before I was able to get started. Hopefully with these tips, you can get started today.
		</p>
		<ul>
			<li><strong>.com Files</strong> - Start with simpler <a href="https://en.wikipedia.org/wiki/COM_file">.com files</a> rather than complex <a href="https://en.wikipedia.org/wiki/DOS_MZ_executable">DOS MZ executable files</a>. MZ executables are complicated enough that you may get completely stuck on just <a href="http://www.techhelpmanual.com/354-exe_file_header_layout.html">parsing the header</a>. MZ executables also support <a href="https://en.wikipedia.org/wiki/X86_memory_segmentation">memory segmentation</a>, <a href="https://en.wikipedia.org/wiki/Relocation_(computing)">relocation tables</a>, and <a href="https://en.wikipedia.org/wiki/Overlay_(programming)">overlays</a>. All advanced features that are hard to implement.</li>
			<li><strong>emu8086</strong> - Download and run <a href="https://emu8086-microprocessor-emulator.en.softonic.com/">emu8086</a>. It is a working, feature-rich emulator and debugger. Great for assembling and running the same programs that you are, stepping through, and checking to make sure your program is working correctly.</li>
			<li><strong>Test Driven Development</strong> - Use the simple assembly programs that come with emu8086. Also google for other simple 8086 assembly programs. Then do test driven development. Implement enough opcodes and syntax to get that particular program working. Get that working perfectly. Then move on to another simple program. Rinse and repeat.</li>
			<!-- give default memory locations and register values -->
			<!-- turn this section into a blog post & Reddit post -->
		</ul>
	</body>
</html>