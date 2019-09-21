#!/usr/bin/expect -f
set username [lindex $argv 0]
set password [lindex $argv 1]

spawn passwd $username
expect "Enter new UNIX password: "
send "$password\r"
expect "Retype new UNIX password: "
send "$password\r"
expect eof