; https://www.geeksforgeeks.org/8086-program-to-find-gcd-of-two-numbers-and-print-the-gcd/?ref=lbp
; 5 errors

.MODEL SMALL 
    .STACK 100H 
    .DATA 
        d1 dw 16 d2 dw 24 
    .CODE 
        MAIN PROC FAR 
            MOV AX, 
    @DATA 
        MOV DS, 
    AX 
  
;initialize ax and bx 
    mov bx, 
    d2 
        mov ax, 
    d1 
  
;find gcd of two numbers 
    call gcd 
  
;load the gcd in ax 
    mov ax, 
    cx 
  
;print the value 
    CALL PRINT 
  
;interrupt to exit
    MOV AH, 
    4CH INT 21H 
  
    MAIN ENDP 
        GCD PROC 
  
;if
    bx is 0 cmp bx, 0 jne continue
  
;then gcd is ax 
    mov cx, 
    ax 
        ret 
  
    continue: 
  
;else gcd(b, a % b) 
    xor dx, 
    dx 
  
;divide ax by bx 
    div bx 
  
;initialize ax as bx 
    mov ax, 
    bx 
  
;and  
bx as ax % bx 
    mov bx, 
    dx 
  
;recursively call gcd 
    call GCD 
        ret 
            GCD ENDP 
                PRINT PROC 
  
;initilize count 
    mov cx, 
    0 mov dx, 0 label1: 
  
;if
    ax is zero 
        cmp ax, 
        0 je print1 
  
   
;initialize bx to 10 mov bx, 10 
  
;extract the last digit 
    div bx 
  
;push it in the stack 
    push dx 
  
;increment the count 
    inc cx 
  
;set dx to 0 
    xor dx, 
    dx 
        jmp label1 
            print1: 
  
;check if count 
;is greater than zero 
    cmp cx, 
    0 je exit
  
;pop the top of stack 
    pop dx 
  
;add 48 so that it 
;represents the ASCII 
;value of digits 
    add dx, 
    48 
  
;interrupt to print a 
;character 
    mov ah, 
    02h int 21h 
  
;decrease the count 
    dec cx 
        jmp print1 
            exit : ret 
                       PRINT ENDP 
                           END MAIN 