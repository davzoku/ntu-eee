			AREA twoLevelCall, CODE, READONLY
RAM_BASE	EQU 0x40000000
			ENTRY
			LDR sp, =RAM_BASE+0x100	;init sp
			LDR r0, =mydata			;get starting address of data
			BL addsqnum				;call addsqnum, pass by register
stop		B stop
mydata		DCD 1, 2, 3, 4
addsqnum
			STMFD sp!, {r4-r6, lr}
			MOV   r1, #0 			;sum
			MOV   r4, #4 			;counter (4 numbers) 
loop		LDR   r5, [r0], #4 		;get value and update
			STMFD sp!, {r5, r6}		;push input/output parameters												
			BL    square			;call square, pass by stack
			LDMFD sp!, {r5, r6}		;pop r5, r6(sq r5)
			ADD   r1, r1, r6   		;sum = sum + sq value
			SUBS  r4, r4, #1   		;dec counter
			BNE loop
			LDMFD sp!, {r4-r6, pc}	;return
square
			STMFD sp!, {r4, r5, lr}
			LDR   r4, [sp, #12]		;get input from stack
			MUL   r5, r4, r4		;squaring
			STR   r5, [sp,#16]		;store result in stack 
			LDMFD sp!,{r4, r5, pc}	;return
			END
