	AREA FactorialPassByReg, CODE, READONLY
RAM_BASE  EQU	 0x40000000
	ENTRY
	LDR   sp, =RAM_BASE+0x100	;init stack poiniter
	MOV	  r0, #10				;n =10, pass by register
	BL 	  factReg				;call factorial
stop	  B stop
factReg
	STMFD sp!, {r4, r5, lr}		;preserves r4, r5 and lr
	MOV   r4, r0				;copy n to temp counter
	MOV   r1, r4				;r1 = result do far
loop1		
	SUBS  r4, r4, #1			;dec counter
	MULNE r5, r1, r4			;n= n*(n-1)
	MOVNE r1, r5
	BNE   loop1					;go again if not zero
	LDMFD sp!, {r4, r5, pc}		;restore r4, r5 and return
	END