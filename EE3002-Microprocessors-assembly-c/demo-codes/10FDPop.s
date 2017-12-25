ram_base EQU 0x40000000
		AREA FDPop, CODE, READONLY
		ENTRY
		LDR sp, =ram_base + 0x100	;sp=0x40000100
		LDMIA sp!, {r0, r1}
stop    B stop
		AREA ramArea, DATA, READWRITE
		SPACE 0x100		;leave a space of 0x100 bytes
stack
		DCD 20,22
		END
