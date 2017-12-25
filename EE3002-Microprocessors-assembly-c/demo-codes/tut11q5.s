RAM_BASE EQU 0x40000000
		AREA thumbSub, CODE, READONLY
		ENTRY
		LDR sp, =RAM_BASE+0x100
		MOV r0, #5
		MOV r1, #3
		BL  veneer		;call veneer
stop	B   stop
veneer
		LDR r4, =thumbAdd+1
		BX  r4		 	;switch to thumb
		CODE16			;following are thumb codes
thumbAdd
		PUSH {r4, r5}	;default is FD stack
		MOV   r4, r0
		MOV   r5, r1
		MUL   r4, r0
		MUL   r5, r1
		ADD   r4, r5
		MOV   r2, r4
		POP  {r4, r5}
		BX    lr
		END
