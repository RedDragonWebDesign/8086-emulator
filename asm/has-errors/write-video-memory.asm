; http://muruganad.com/8086/8086-Assembly-Writing-Directly-to-Video-Memory-B800.html
; 2 errors in emu8086
.model tiny  		  		; com program
.code			  		; code segment
org 100h		  		; code starts at offset 100h	

main proc near
  mov ax,b800h
  mov es,ax
  mov mov ax,offset message 		; offset ofMessage string terminating with $
  mov si,ax                             ; Make Si point to string address
  mov di,0                              ; Make Destination Index point to B800:0000
loop1:
  mov al,[si]				; Read First Character
  mov es:[di],al                        ; Write to Video
  inc si                                ; Point to next character
  inc di
  inc di                                ; Next Display Area
  cmp al,'&'
  jne loop1                             ; if not '$' jump to loop1 				
 
  mov ah,4ch               		; function to terminate
  mov al,00
  int 21h  		   		; Dos Interrupt 
endp 
message db "Hello World $"		; Message to be displayed terminating with a $
end main