			AREA AP, CODE, READONLY

TABLE_BASE	EQU 0x00008000				;base of table
			ENTRY
			MOV  r0, #5					;n = 5
			MOV  r1, #1					;a1 = 1
			MOV  r2, #4					;d = 4
			MOV  r3, #TABLE_BASE 		
			MOV  r4, #0
		
			STR  r1, [r3]				;store AP(1)

loop		ADD r4, r4, #1				;i = i + 1
			CMP r4, r0					;i < n, proceed
			BGE done					;else finish!
		
			ADD r1, r1, r2				;AP(i) = AP(i-1) + d
			STR r1, [r3, r4, LSL#2]		;store AP(i)
			B loop

done		B done
			END
