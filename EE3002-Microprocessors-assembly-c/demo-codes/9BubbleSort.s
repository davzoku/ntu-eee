		AREA BubbleSort, CODE, READONLY
num		EQU	20
		ENTRY
		MOV	r0, #num	  	;n
		SUB r1, r0, #1		;n-1
		LDR r2, =elements	;base address of table
		MOV r3, #0			;loop counter i

loop1	CMP r3, r0			;i < n
		BGE done 			;done
        MOV	r4, #0			;loop counter j
loop2   CMP r4, r1			;j < (n-1)
		BGE end2
		ADD r5, r4, #1		;j+1		
		LDR r6, [r2, r4, LSL #2]	;load entry[j]
		LDR r7, [r2, r5, LSL #2]	;load entry[j+1]
		CMP r6, r7
		BLE	Noswap
		STR r6, [r2, r5, LSL #2]	;swap if necessary
		STR r7, [r2, r4, LSL #2]
Noswap	ADD r4, r4, #1	 	;inc j
		B   loop2
end2	ADD r3, r3, #1		;inc i
		B   loop1

done	B done

		AREA data1, DATA, READWRITE
elements
		DCD 3,4,2,54,6,33,-5,2,1,0
		DCD 77,1,2,3,0,-5,-35,3,4,1
		END



































