; http://www2.imm.dtu.dk/courses/02131/asm/asm01001.htm
; 0 errors
.model small
.stack
.data
message   db "Hello world, I'm learning Assembly !!!", "$"

.code

main   proc
   mov   ax,seg message
   mov   ds,ax

   mov   ah,09
   lea   dx,message
   int   21h

   mov   ax,4c00h
   int   21h
main   endp
end main