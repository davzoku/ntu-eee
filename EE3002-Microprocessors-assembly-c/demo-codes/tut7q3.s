	AREA JmpTable, CODE, READONLY
	ENTRY
start
	MOV r0, #1 			;first parameter determines
						;function to be performed
						;0 = add
						;1 = subtract
						;2 = multiply
	MOV r1, #0x10 		;1st operand
	MOV r2, #0x5		;2nd operand

	BL  arithfunc 		;call the arithmetic function
stop B  stop

arithfunc
	LDR   r3, =jumpTable 		;load address of jump table
	LDR   pc, [r3, r0, LSL #2]	;jump to appropriate routine
								;addresses are each 4 bytes
jumpTable
	DCD DoAdd
	DCD DoSubtract
	DCD DoMultiply
DoAdd
	ADD r4, r1, r2
	BX  lr
DoSubtract
	SUB r4, r1, r2
	BX  lr
DoMultiply
	MUL r4, r1, r2
	BX  lr
	END
