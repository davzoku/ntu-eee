		AREA UARTdemo, CODE, READONLY
PINSEL0	 EQU 0xE002C000		;controls the fn of the pins
U0START	 EQU 0xE000C000		;start of UART0 registers
LCR0	 EQU 0xC			;line control register
LSR0	 EQU 0x14		 	;line status register
RAMSTART EQU 0x40000000	 	;start of onboard RAM
		ENTRY
start	LDR	sp, =RAMSTART 	;setup sp
		BL  UARTconfig		;init UART0
		LDR	r1, =CharData	;start of characters

loop	LDRB r0, [r1], #1	;load char and incr addr
		CMP  r0, #0			;null terminator?
		BLNE Transmit		;send char to UART
		BNE  loop
		
done	B	done

UARTconfig
		STMEA sp!, {r5, r6, lr}
		LDR   r5, =PINSEL0	;base address of register
		LDR	  r6, [r5]		;get content
		BIC   r6, r6, #0xF	;clear out lower nibble
		ORR   r6, r6, #0x5	;set Tx0 and Rx0

		STR   r6, [r5]		
		LDR   r5, =U0START
		MOV   r6, #0x83		;set 8 bits, no parity,
							;1 stop bit
		STRB  r6, [r5, #LCR0]
		MOV   r6, #0x61
		STRB  r6, [r5]
		MOV   r6, #3
		STRB  r6, [r5, #LCR0]
		LDMEA sp!, {r5, r6, pc}
 
Transmit
		STMEA sp!, {r5, r6, lr}
		LDR   r5, =U0START
wait	LDRB  r6, [r5, #LSR0]  	;get atatus of buffer
		CMP   r6, #0x20			;buffer empty?
		BEQ   wait
		STRB  r0, [r5]
		LDMEA sp!, {r5, r6, pc}

CharData
		DCB   "Hello everybody, welcome to the world!"
		;ALIGN
		END				