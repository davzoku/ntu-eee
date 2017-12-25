ram_base EQU 0x40000000
			AREA PassParaReg, CODE, READONLY
			ENTRY
main		
			LDR sp, =ram_base + 0x100
			MOV r0, #0			;shift left
			LDR r1, =0x00012340	;operand
			MOV r2, #4			;shift 4 bits
			BL  shiftfunc		;call subroutine shiftfunc
stop		B   stop			;return from shiftfunc
shiftfunc		
			STMFD sp!, {r4, lr}	;PUSH r4, lr to stack
			MOV   r4, #0		;r4 - temporary register
			CMP   r0, r4
			MOVEQ r3, r1, LSL r2	;r0=0 implies shift left
			MOVNE r3, r1, LSR r2	;else shift right
			LDMFD sp!, {r4, pc}		;restore r4 and pop lr to pc
			END