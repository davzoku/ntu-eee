			AREA tut8q2, CODE
			ENTRY

			MOV r0, #0x10					
			MOV r4, #0x14
			MOV r7, #0x17
			MOV r6, #0x8000
			MOV lr, #0xAB

			STMIA r6, {r7,r4, r0, lr}

stop		B stop
			END
