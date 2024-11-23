sudo nmcli connection add type 802-11-wireless con-name <connection name> ssid myssid 802-11-wireless-security.key-mgmt WPA-PSK 802-11-wireless-security.psk myssid
sudo nmcli con mod <connection name> connection.autoconnect true
sudo nmcli connection up <connection name>
