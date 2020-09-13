; https://www.geeksforgeeks.org/8086-program-to-print-a-string/
; 0 errors

.MODEL SMALL  
.STACK 100H  
.DATA  
  
;The string to be printed  
STRING DB 'This is a sample string', '$'
  
.CODE  
MAIN PROC FAR  
 MOV AX,@DATA  
 MOV DS,AX  
  
 ; load address of the string  
 LEA DX,STRING  
  
 ;output the string 
 ;loaded in dx  
 MOV AH,09H 
 INT 21H  
  
 ;interrupt to exit
 MOV AH,4CH 
 INT 21H  
  
MAIN ENDP  
END MAIN  