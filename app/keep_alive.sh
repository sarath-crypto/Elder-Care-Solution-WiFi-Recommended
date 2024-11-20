while true
do 
	cmd=$(pgrep ecsysapp)
	if [ -z "$cmd" ]; then
		/home/ecsys/app/ecsysapp
	fi
	sleep 30
done
