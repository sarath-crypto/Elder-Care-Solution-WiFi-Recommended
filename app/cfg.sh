arecord -l

NumberOfEvents=$(ls /dev/input | grep -c event*)

i=0
while [ $i -lt $NumberOfEvents ]; do
    Name=$(cat /sys/class/input/event$i/device/name)
    echo event$i $Name
    let i=i+1
done

#.bashrc
#cmd=$(pgrep ecsysapp)
#if [ -z "$cmd" ]; then
#        /home/ecsys/app/keep_alive.sh &
#        tput civis
#        PS1=""
#fi
