<?php
/**
 * Kouloughli Hemza
 */
namespace Kouloughli\Helpers;

class Helper
{
    public static function getMac()
    {
        $ipAddress=$_SERVER['REMOTE_ADDR'];
        $macAddr=false;

        #run the external command, break output into lines
        $arp=`arp -a $ipAddress`;
        $lines=explode("\n", $arp);

        #look for the output line describing our IP address
        foreach($lines as $line)
        {
            $cols=preg_split('/\s+/', trim($line));
            if ($cols[0]==$ipAddress)
            {
                $macAddr=$cols[1];
            }
        }
        return $macAddr;
    }


    public static function diskSpace()
    {

        /* get disk space free (in bytes) */
        $path = base_path();
        $df = disk_free_space($path);
        /* and get disk space total (in bytes)  */
        $dt = disk_total_space($path);
        /* now we calculate the disk space used (in bytes) */
        $du = $dt - $df;
        /* percentage of disk used - this will be used to also set the width % of the progress bar */
        $dp = sprintf('%.2f',($du / $dt) * 100);

        $data = ['freeSpace' => self::formatSize($df),'totalSpace' => self::formatSize($dt),
            'usedSpace' => self::formatSize($du),'spacePercentage' => $dp  ];
        return $data;

    }

    private static function formatSize($bytes)
    {
        $types = array( 'B', 'KB', 'MB', 'GB', 'TB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $types ) -1 ); $bytes /= 1024, $i++ );
        return( round( $bytes, 2 ) . " " . $types[$i] );
    }
}