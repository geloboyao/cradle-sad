<?php //-->
/**
 * This file is part of the Cradle PHP Library.
 * (c) 2016-2018 Acme Products Inc.
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

namespace Cradle\App\Core;

/**
 * Typical model create action steps
 *
 * @vendor   Cradle
 * @package  Framework
 * @author   John Doe <john@acme.com>
 * @standard PSR-2
 */
class File
{
    /**
     * Determine the Extension from data
     *
     * @param string
     * @return string
     */
    public static function getExtensionFromData($data)
    {
        $extension = 'unknown';

        $mime = self::getMimeFromData($data);

        //find out the extension
        foreach (self::$mimeTypes as $extension => $mimeType) {
            if ($mimeType === $mime) {
                break;
            }
        }

        return $extension;
    }

    /**
     * Determine the Mime from data
     *
     * @param string
     * @return string
     */
    public static function getMimeFromData($data)
    {
        $mime  = 'application/octet-stream';

        $data = urldecode($data);
        //data:mime;base64,data
        $data = substr($data, 5);

        $chunks = explode(';base64,', $data);
        return array_shift($chunks);
    }

    /**
     * Determine the Extension from a link
     *
     * @param string
     * @return string
     */
    public static function getExtensionFromLink($link)
    {
        $extension     = 'unknown';

        $path         = explode('/', $link);
        $file         = array_pop($path);

        if (strpos($file, '.') !== false) {
            $file = explode('.', $file);
            $extension = array_pop($file);
        }

        return $extension;
    }

    /**
     * Determine the Extension from a link
     *
     * @param string
     * @return string
     */
    public static function getMimeFromLink($link)
    {
        $mime  = 'application/octet-stream';

        $extension = self::getExtensionFromLink($link);

        if (isset(self::$mimeTypes[$extension])) {
            $mime = self::$mimeTypes[$extension];
        }

        return $mime;
    }

    /**
     * @var array $mimeTypes static list of extensions to mime
     */
    private static $mimeTypes = array(
        'ai'        => 'application/postscript',        'aif'       => 'audio/x-aiff',
        'aifc'      => 'audio/x-aiff',                  'aiff'      => 'audio/x-aiff',
        'asc'       => 'text/plain',                    'atom'      => 'application/atom+xml',
        'au'        => 'audio/basic',                   'avi'       => 'video/x-msvideo',
        'bcpio'     => 'application/x-bcpio',           'bin'       => 'application/octet-stream',
        'bmp'       => 'image/bmp',                     'cdf'       => 'application/x-netcdf',
        'cgm'       => 'image/cgm',                     'class'     => 'application/octet-stream',
        'cpio'      => 'application/x-cpio',            'cpt'       => 'application/mac-compactpro',
        'csh'       => 'application/x-csh',             'css'       => 'text/css',
        'dcr'       => 'application/x-director',        'dif'       => 'video/x-dv',
        'dir'       => 'application/x-director',        'djv'       => 'image/vnd.djvu',
        'djvu'      => 'image/vnd.djvu',                'dll'       => 'application/octet-stream',
        'dmg'       => 'application/octet-stream',      'dms'       => 'application/octet-stream',
        'doc'       => 'application/msword',            'dtd'       => 'application/xml-dtd',
        'dv'        => 'video/x-dv',                    'dvi'       => 'application/x-dvi',
        'dxr'       => 'application/x-director',        'eps'       => 'application/postscript',
        'etx'       => 'text/x-setext',                 'exe'       => 'application/octet-stream',
        'ez'        => 'application/andrew-inset',      'gif'       => 'image/gif',
        'gram'      => 'application/srgs',              'grxml'     => 'application/srgs+xml',
        'gtar'      => 'application/x-gtar',            'hdf'       => 'application/x-hdf',
        'hqx'       => 'application/mac-binhex40',      'htm'       => 'text/html',
        'html'      => 'text/html',                     'ice'       => 'x-conference/x-cooltalk',
        'ico'       => 'image/x-icon',                  'ics'       => 'text/calendar',
        'ief'       => 'image/ief',                     'ifb'       => 'text/calendar',
        'iges'      => 'model/iges',                    'igs'       => 'model/iges',
        'jnlp'      => 'application/x-java-jnlp-file',  'jp2'       => 'image/jp2',
        'jpg'       => 'image/jpeg',                    'jpeg'      => 'image/jpeg',
        'jpe'       => 'image/jpeg',                    'js'        => 'application/x-javascript',
        'kar'       => 'audio/midi',                    'latex'     => 'application/x-latex',
        'lha'       => 'application/octet-stream',      'lzh'       => 'application/octet-stream',
        'm3u'       => 'audio/x-mpegurl',               'm4a'       => 'audio/mp4a-latm',
        'm4b'       => 'audio/mp4a-latm',               'm4p'       => 'audio/mp4a-latm',
        'm4u'       => 'video/vnd.mpegurl',             'm4v'       => 'video/x-m4v',
        'mac'       => 'image/x-macpaint',              'man'       => 'application/x-troff-man',
        'mathml'    => 'application/mathml+xml',        'me'        => 'application/x-troff-me',
        'mesh'      => 'model/mesh',                    'mid'       => 'audio/midi',
        'midi'      => 'audio/midi',                    'mif'       => 'application/vnd.mif',
        'mov'       => 'video/quicktime',               'movie'     => 'video/x-sgi-movie',
        'mp2'       => 'audio/mpeg',                    'mp3'       => 'audio/mpeg',
        'mp4'       => 'video/mp4',                     'mpe'       => 'video/mpeg',
        'mpeg'      => 'video/mpeg',                    'mpg'       => 'video/mpeg',
        'mpga'      => 'audio/mpeg',                    'ms'        => 'application/x-troff-ms',
        'msh'       => 'model/mesh',                    'mxu'       => 'video/vnd.mpegurl',
        'nc'        => 'application/x-netcdf',          'oda'       => 'application/oda',
        'ogg'       => 'application/ogg',               'pbm'       => 'image/x-portable-bitmap',
        'pct'       => 'image/pict',                    'pdb'       => 'chemical/x-pdb',
        'pdf'       => 'application/pdf',               'pgm'       => 'image/x-portable-graymap',
        'pgn'       => 'application/x-chess-pgn',       'pic'       => 'image/pict',
        'pict'      => 'image/pict',                    'png'       => 'image/png',
        'pnm'       => 'image/x-portable-anymap',       'pnt'       => 'image/x-macpaint',
        'pntg'      => 'image/x-macpaint',              'ppm'       => 'image/x-portable-pixmap',
        'ppt'       => 'application/vnd.ms-powerpoint', 'ps'        => 'application/postscript',
        'qt'        => 'video/quicktime',               'qti'       => 'image/x-quicktime',
        'qtif'      => 'image/x-quicktime',             'ra'        => 'audio/x-pn-realaudio',
        'ram'       => 'audio/x-pn-realaudio',          'ras'       => 'image/x-cmu-raster',
        'rdf'       => 'application/rdf+xml',           'rgb'       => 'image/x-rgb',
        'rm'        => 'application/vnd.rn-realmedia',  'roff'      => 'application/x-troff',
        'rtf'       => 'text/rtf',                      'rtx'       => 'text/richtext',
        'sgm'       => 'text/sgml',                     'sgml'      => 'text/sgml',
        'sh'        => 'application/x-sh',              'shar'      => 'application/x-shar',
        'silo'      => 'model/mesh',                    'sit'       => 'application/x-stuffit',
        'skd'       => 'application/x-koan',            'skm'       => 'application/x-koan',
        'skp'       => 'application/x-koan',            'skt'       => 'application/x-koan',
        'smi'       => 'application/smil',              'smil'      => 'application/smil',
        'snd'       => 'audio/basic',                   'so'        => 'application/octet-stream',
        'spl'       => 'application/x-futuresplash',    'src'       => 'application/x-wais-source',
        'sv4cpio'   => 'application/x-sv4cpio',         'sv4crc'    => 'application/x-sv4crc',
        'svg'       => 'image/svg+xml',                 'swf'       => 'application/x-shockwave-flash',
        't'         => 'application/x-troff',           'tar'       => 'application/x-tar',
        'tcl'       => 'application/x-tcl',             'tex'       => 'application/x-tex',
        'texi'      => 'application/x-texinfo',         'texinfo'   => 'application/x-texinfo',
        'tif'       => 'image/tiff',                    'tiff'      => 'image/tiff',
        'tr'        => 'application/x-troff',           'tsv'       => 'text/tab-separated-values',
        'txt'       => 'text/plain',                    'ustar'     => 'application/x-ustar',
        'vcd'       => 'application/x-cdlink',          'vrml'      => 'model/vrml',
        'vxml'      => 'application/voicexml+xml',      'wav'       => 'audio/x-wav',
        'wbmp'      => 'image/vnd.wap.wbmp',            'wbmxl'     => 'application/vnd.wap.wbxml',
        'wml'       => 'text/vnd.wap.wml',              'wmlc'      => 'application/vnd.wap.wmlc',
        'wmls'      => 'text/vnd.wap.wmlscript',        'wmlsc'     => 'application/vnd.wap.wmlscriptc',
        'wrl'       => 'model/vrml',                    'xbm'       => 'image/x-xbitmap',
        'xht'       => 'application/xhtml+xml',         'xhtml'     => 'application/xhtml+xml',
        'xls'       => 'application/vnd.ms-excel',      'xml'       => 'application/xml',
        'xpm'       => 'image/x-xpixmap',               'xsl'       => 'application/xml',
        'xslt'      => 'application/xslt+xml',          'xul'       => 'application/vnd.mozilla.xul+xml',
        'xwd'       => 'image/x-xwindowdump',           'xyz'       => 'chemical/x-xyz',
        'zip'       => 'application/zip');
}
