			AREA tut8q5, CODE
			ENTRY
			LDR r0, =0x1123
			LDR r1, =0x2234
			LDR r2, =0x3356
			LDR sp, =0x40001000
			STMFD sp!, {r0-r1}		;PUSH r0, r1
			STMFD sp!, {r2}			;PUSH r2
			LDMFD sp!, {r0,r2}		;POP r0, r2
			LDMFD sp!, {r1}			;POP r1
stop		B stop
			END
