	AREA Celsius_to_Fahrenheit, CODE, READONLY 
	ENTRY
	; This program converts Celsius to Fahrenheit, F=1.8C+32
	; End Result, r0= C, r1 = 1.8, r2 = round(F) in Q0, r3 = F in Q15 
CELS EQU  0xF                   ; Enter your C value in Q0 format. eg 0xF = 15C
	LDR  r0, =CELS      		; load Celsius value in Q0 format
	LDR  r1, =0xE666     		; load 1.8 in Q15 format
	MUL  r3, r0, r1          	; signed multiply, result in Q15
	LDR  r2, =0x100000 			; load 32 in Q15
	ADD  r3, r3, r2          	; add 32
	ADD  r2, r3, #0x4000 		; add 0.5 before truncation (for round up)
	MOV  r2, r2, LSR #15 		; shift right 15 to convert to Q0

stop 	B    stop		
	END
