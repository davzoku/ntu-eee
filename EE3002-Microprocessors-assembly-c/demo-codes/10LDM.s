ram_base EQU 0x40000000
		AREA LDMexample, CODE, READONLY
		ENTRY
		LDR r9, =ram_base + 0x100	;r9=0x40000100
		LDM r9, {r4, r1-r3}
stop    B stop
		AREA ramArea, DATA, READWRITE
		SPACE 0x100		;leave a space of 0x100 bytes
stack
		DCD 1, 2, 3, 4
		END
