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
			8086 Assembly:<br />
			<textarea id="assembly"></textarea><br />
			<button id="assemble">Assemble</button>
		</p>
		<p>
			Listing:<br />
			<textarea id="listing"></textarea>
		</p>
		<p>
			Binary:<br />
			<textarea id="binary"></textarea>
		</p>
		<p>
			Memory:<br />
			<span class="stack">Stack</span>
			<span class="heap">Heap</span>
			<span class="bios">BIOS</span>
			<span class="dos">DOS</span>
			<span class="this-application">This Application</span>
			<span class="unallocated">Unallocated</span><br />
			<textarea id="memory"></textarea>
		</p>
		<p>
			Emulator Important Variables:<br />
			<textarea id="variables">
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
			Registers:<br />
			<textarea id="registers"></textarea>
		</p>
		<p>
			<button id="step">Step</button>
			<button id="run">Run</button>
		</p>
		<p>
			Console:<br />
			<textarea id="console"></textarea>
		</p>
		<p>
			We support...
			<ul>
				<li>
					Opcodes
					<ul>
						<li>mov</li>
						<li>int</li>
						<li>10h</li>
						<li>add</li>
						<li>loop</li>
						<li>ret</li>
					</ul>						
				</li>
				<li>
					Interrupts
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
					I/O Ports
				</li>
			</ul>
		</p>
		<p class="above-ul">
			Some light reading:
		</p>
		<ul>
			<li>
				Opcodes / Assembly Language
				<ul>
					<li>
						<a href="https://en.wikipedia.org/wiki/X86_instruction_listings#x86_integer_instructions">
							https://en.wikipedia.org/wiki/X86_instruction_listings#x86_integer_instructions
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/X86_assembly_language">
							https://en.wikipedia.org/wiki/X86_assembly_language
						</a>
					</li>
					<li>
						<a href="https://pdos.csail.mit.edu/6.828/2005/readings/i386/c17.htm">
							https://pdos.csail.mit.edu/6.828/2005/readings/i386/c17.htm
						</a>
					</li>
					<li>
						<a href="http://www.mathemainzel.info/files/x86asmref.html">
							http://www.mathemainzel.info/files/x86asmref.html
						</a>
					</li>
					<li>
						<a href="https://godbolt.org/">
							<mark>https://godbolt.org/ - translates C to assembly</mark>
						</a>
					</li>
					<li>
						<a href="file:///C:/emu8086/documentation/8086_instruction_set.html">
							<mark>file:///C:/emu8086/documentation/8086_instruction_set.html - 8086 opcodes with algorithms</mark>
						</a>
					</li>
				</ul>
			</li>
			<li>
				Instruction Set Architecture (ISA) / PCode / SLEIGH
				<ul>
					<li>
						<a href="https://medium.com/@cetfor/emulating-ghidras-pcode-why-how-dd736d22dfb">
							https://medium.com/@cetfor/emulating-ghidras-pcode-why-how-dd736d22dfb
						</a>
					</li>
					<li>
						<a href="https://github.com/NationalSecurityAgency/ghidra/tree/master/Ghidra/Processors/x86/data/languages">
							https://github.com/NationalSecurityAgency/ghidra/tree/master/Ghidra/Processors/x86/data/languages
						</a>
					</li>
					<li>
						<a href="https://github.com/NationalSecurityAgency/ghidra/pull/1430/files">
							https://github.com/NationalSecurityAgency/ghidra/pull/1430/files
						</a>
					</li>
					<li>
						<a href="https://github.com/NationalSecurityAgency/ghidra/commit/23d1e9ad22b875d68c70b6d22cb74767cf03be3e">
							https://github.com/NationalSecurityAgency/ghidra/commit/23d1e9ad22b875d68c70b6d22cb74767cf03be3e
						</a>
					</li>
					<li>
						<a href="https://www.reddit.com/r/ghidra/comments/f5lk42/my_experience_writing_processor_modules/">
							https://www.reddit.com/r/ghidra/comments/f5lk42/my_experience_writing_processor_modules/
						</a>
					</li>
					<li>
						<a href="https://spinsel.dev/2020/06/17/ghidra-brainfuck-processor-1.html">
							https://spinsel.dev/2020/06/17/ghidra-brainfuck-processor-1.html
						</a>
					</li>
					<li>
						<a href="https://ghidra.re/courses/languages/html/sleigh.html">
							https://ghidra.re/courses/languages/html/sleigh.html
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Instruction_set_architecture">
							https://en.wikipedia.org/wiki/Instruction_set_architecture
						</a>
					</li>
				</ul>
			</li>
			<li>
				Assemblers / Disassemblers
				<ul>
					<li>
						<a href="https://en.wikipedia.org/wiki/Assembly_language#Assembler">
							https://en.wikipedia.org/wiki/Assembly_language#Assembler
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Disassembler">
							https://en.wikipedia.org/wiki/Disassembler
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Decompiler">
							https://en.wikipedia.org/wiki/Decompiler
						</a>
					</li>
					<li>
						<a href="https://www.geeksforgeeks.org/introduction-of-assembler/">
							https://www.geeksforgeeks.org/introduction-of-assembler/ - 2 pass assemblers
						</a>
					</li>
				</ul>
			</li>
			<li>
				Software Interrupts / DOS API / BIOS API
				<ul>
					<li>
						<a href="http://www.ctyme.com/intr/int.htm">
							<mark>
								http://www.ctyme.com/intr/int.htm
							</mark>
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/DOS_API">
							https://en.wikipedia.org/wiki/DOS_API
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/BIOS_interrupt_call">
							https://en.wikipedia.org/wiki/BIOS_interrupt_call
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Interrupt">
							https://en.wikipedia.org/wiki/Interrupt
						</a>
					</li>
					<li>
						<a href="http://www.ctyme.com/intr/int-21.htm">
							http://www.ctyme.com/intr/int-21.htm
						</a>
					</li>
					<li>
						<a href="https://jdebp.eu/FGA/dos-api-bindings.html">
							https://jdebp.eu/FGA/dos-api-bindings.html - DOS API libraries in C
						</a>
					</li>
				</ul>
			</li>
			<li>
				Registers
				<ul>
					<li>
						<a href="https://en.wikipedia.org/wiki/Processor_register">
							https://en.wikipedia.org/wiki/Processor_register
						</a>
					</li>
					<li>
						<a href="https://www.byclb.com/TR/Tutorials/microprocessors/ch2_1.htm">
							https://www.byclb.com/TR/Tutorials/microprocessors/ch2_1.htm
						</a>
					</li>
					<li>
						<a href="http://www1.frm.utn.edu.ar/arquitectura/t86.pdf">
							http://www1.frm.utn.edu.ar/arquitectura/t86.pdf - great description of registers
						</a>
					</li>
				</ul>
			</li>
			<li>
				Executables / Headers
				<ul>
					<li>
						<a href="http://www.delorie.com/djgpp/doc/exe/">
							http://www.delorie.com/djgpp/doc/exe/
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/DOS_MZ_executable">
							https://en.wikipedia.org/wiki/DOS_MZ_executable
						</a>
					</li>
					<li>
						<a href="https://wiki.osdev.org/MZ">
							https://wiki.osdev.org/MZ
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Relocation_(computing)#Relocation_table">
							https://en.wikipedia.org/wiki/Relocation_(computing)#Relocation_table
						</a>
					</li>
					<li>
						<a href="http://www.techhelpmanual.com/354-exe_file_header_layout.html">
							http://www.techhelpmanual.com/354-exe_file_header_layout.html
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/COM_file">
							https://en.wikipedia.org/wiki/COM_file
						</a>
					</li>
					<li>
						<a href="https://stackoverflow.com/questions/25187822/x86-segmentation-dos-mz-file-format-and-disassembling">
							https://stackoverflow.com/questions/25187822/x86-segmentation-dos-mz-file-format-and-disassembling
						</a>
					</li>
				</ul>
			</li>
			<li>
				Memory / Mode / Segments
				<ul>
					<li>
						<a href="https://en.wikipedia.org/wiki/X86_memory_segmentation">
							https://en.wikipedia.org/wiki/X86_memory_segmentation
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Code_segment">
							https://en.wikipedia.org/wiki/Code_segment
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Data_segment">
							https://en.wikipedia.org/wiki/Data_segment
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/.bss">
							https://en.wikipedia.org/wiki/.bss
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Memory_segmentation">
							https://en.wikipedia.org/wiki/Memory_segmentation
						</a>
					</li>
					<li>
						<a href="https://en.wikipedia.org/wiki/Zero_page">
							https://en.wikipedia.org/wiki/Zero_page
						</a>
					</li>
					<li>
						<a href="http://www.c-jump.com/CIS77/ASM/Memory/lecture.html">
							http://www.c-jump.com/CIS77/ASM/Memory/lecture.html
						</a>
					</li>
					<li>
						<a href="https://stackoverflow.com/a/29430821/3480193">
							https://stackoverflow.com/a/29430821/3480193 - Short/Long/Far Jump
						</a>
					</li>
					<li>
						<a href="https://www.drdobbs.com/architecture-and-design/mapping-dos-memory-allocation/184408026">
							https://www.drdobbs.com/architecture-and-design/mapping-dos-memory-allocation/184408026 - DOS Memory Map
						</a>
					</li>
					<li>
						<a href="file:///C:/emu8086/documentation/memory.html">
							file:///C:/emu8086/documentation/memory.html
						</a>
					</li>
				</ul>
			</li>
			<li>
				Emulators / DOSBox
				<ul>
					<li>
						<a href="https://github.com/dosbox-staging/dosbox-staging">
							https://github.com/dosbox-staging/dosbox-staging
						</a>
					</li>
					<li>
						<a href="https://www.vogons.org/">
							https://www.vogons.org/
						</a>
					</li>
					<li>
						<a href="https://emu8086-microprocessor-emulator.en.softonic.com/download">
							<mark>
								https://emu8086-microprocessor-emulator.en.softonic.com/download - 8086 assembler & emulator & debugger
							</mark>
						</a>
					</li>
					<li>
						<a href="file:///C:/emu8086/documentation/index.html">
							file:///C:/emu8086/documentation/index.html
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</body>
</html>