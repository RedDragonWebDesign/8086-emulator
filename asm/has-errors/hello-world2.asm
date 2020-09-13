; http://muruganad.com/8086/8086-Assembly-Hello-World-Application.html
; 2 errors in emu8086
.model tiny  		  		; com program
.code			  		; code segment
org 100h		  		; code starts at offset 100h	

main proc near
  mov ah,09h		   		; function to display a string 	
  mov mov dx,offset message 		; offset ofMessage string terminating with $
  int 21h                  		; dos interrupt
  mov ah,4ch               		; function to terminate
  mov al,00
  int 21h  		   		; Dos Interrupt 
endp 
message db "Hello World $"		; Message to be displayed terminating with a $
end main
