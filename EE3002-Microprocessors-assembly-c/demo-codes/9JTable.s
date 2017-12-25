		AREA JumpTable, CODE, READONLY
		ENTRY
start
		MOV 	r0, #0
		MOV		r1, #3
		MOV		r2, #2
		BL		arithfunc
stop	B		stop
arithfunc
		ADR		r3, jumpTable
		LDR		pc, [r3, r0, LSL #2]
jumpTable
		DCD		DoAdd
		DCD		DoSub
DoAdd
		ADD		r4, r1, r2
		BX		lr
DoSub	
		SUB		r4, r1, r2
		BX 		lr
		END
