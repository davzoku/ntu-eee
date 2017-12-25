ram_base EQU 0x40000000
			AREA PassParaStack, CODE, READONLY
			ENTRY
main		
			LDR sp, =ram_base + 0x100
			MOV r0, #0			;shift left
			LDR r1, =0x00001234	;operand
			MOV r2, #4			;shift 4 bits
			STMFD sp!, {r0-r3}	;stack in/out parameters to stack
			BL  shiftfunc		;call subroutine shiftfunc
			LDMFD sp!, {r0-r3} 	;pop in/out parameters from stack
								;result in r3
stop		B   stop			;return from shiftfunc
shiftfunc		
			STMFD sp!, {r4-r7, lr}	;PUSH r4-r7, lr to stack (5 regs)
			LDR   r4, [sp, #20]		;r4=option, offset=5*4=20 bytes
			LDR   r5, [sp, #24]		;r5=operand
			LDR   r6, [sp, #28]		;r6=shift no. of bits
			MOV   r7, #0			;r7 - temporary register
			CMP   r4, r7
			MOVEQ r7, r5, LSL r6	;r0=0 implies shift left
			MOVNE r7, r5, LSR r6	;else shift right
			STR   r7, [sp, #32]		;store result in stack
			LDMFD sp!, {r4-r7, pc}	;restore r4-r7 and 
									;pop lr to pc to return
			END