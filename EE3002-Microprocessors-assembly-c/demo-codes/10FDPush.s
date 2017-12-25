ram_base EQU 0x40000000
		AREA FDPush, CODE, READONLY
		ENTRY
		LDR sp, =ram_base + 0x100	;sp=0x40000100
		MOV r0, #10
		MOV r1, #11
		STMDB sp!, {r0, r1}
stop    B stop
		END

		