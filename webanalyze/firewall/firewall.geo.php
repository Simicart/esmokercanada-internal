<?php

class sg_Geo_IP2Country_alone
{

    private static $DATA_SECTION_SEPARATOR_SIZE = 16;
    private static $METADATA_START_MARKER = "\xAB\xCD\xEFMaxMind.com";
    private static $METADATA_START_MARKER_LENGTH = 14;
    private static $METADATA_MAX_SIZE = 131072; // 128 * 1024 = 128KB

    private $decoder;
    private $fileHandle;
    private $fileSize;
    private $ipV4Start;
    private $metadata;
    private $fileStream;
    private $pointerBase;
    // This is only used for unit testing
    private $pointerTestHack;
    private $switchByteOrder;

    private $types = array(
        0 => 'extended',
        1 => 'pointer',
        2 => 'utf8_string',
        3 => 'double',
        4 => 'bytes',
        5 => 'uint16',
        6 => 'uint32',
        7 => 'map',
        8 => 'int32',
        9 => 'uint64',
        10 => 'uint128',
        11 => 'array',
        12 => 'container',
        13 => 'end_marker',
        14 => 'boolean',
        15 => 'float',
    );
	
	private $map = array(
	'A1' => "Anonymous Proxy",
	'A2' => "Satellite Provider",
	'O1' => "Other Country",
	'AD' => "Andorra",
	'AE' => "United Arab Emirates",
	'AF' => "Afghanistan",
	'AG' => "Antigua and Barbuda",
	'AI' => "Anguilla",
	'AL' => "Albania",
	'AM' => "Armenia",
	'AO' => "Angola",
	'AP' => "Asia/Pacific Region",
	'AQ' => "Antarctica",
	'AR' => "Argentina",
	'AS' => "American Samoa",
	'AT' => "Austria",
	'AU' => "Australia",
	'AW' => "Aruba",
	'AX' => "Aland Islands",
	'AZ' => "Azerbaijan",
	'BA' => "Bosnia and Herzegovina",
	'BB' => "Barbados",
	'BD' => "Bangladesh",
	'BE' => "Belgium",
	'BF' => "Burkina Faso",
	'BG' => "Bulgaria",
	'BH' => "Bahrain",
	'BI' => "Burundi",
	'BJ' => "Benin",
	'BL' => "Saint Bartelemey",
	'BM' => "Bermuda",
	'BN' => "Brunei Darussalam",
	'BO' => "Bolivia",
	'BQ' => "Bonaire, Saint Eustatius and Saba",
	'BR' => "Brazil",
	'BS' => "Bahamas",
	'BT' => "Bhutan",
	'BV' => "Bouvet Island",
	'BW' => "Botswana",
	'BY' => "Belarus",
	'BZ' => "Belize",
	'CA' => "Canada",
	'CC' => "Cocos (Keeling) Islands",
	'CD' => "Congo, The Democratic Republic of the",
	'CF' => "Central African Republic",
	'CG' => "Congo",
	'CH' => "Switzerland",
	'CI' => "Cote d'Ivoire",
	'CK' => "Cook Islands",
	'CL' => "Chile",
	'CM' => "Cameroon",
	'CN' => "China",
	'CO' => "Colombia",
	'CR' => "Costa Rica",
	'CU' => "Cuba",
	'CV' => "Cape Verde",
	'CW' => "Curacao",
	'CX' => "Christmas Island",
	'CY' => "Cyprus",
	'CZ' => "Czech Republic",
	'DE' => "Germany",
	'DJ' => "Djibouti",
	'DK' => "Denmark",
	'DM' => "Dominica",
	'DO' => "Dominican Republic",
	'DZ' => "Algeria",
	'EC' => "Ecuador",
	'EE' => "Estonia",
	'EG' => "Egypt",
	'EH' => "Western Sahara",
	'ER' => "Eritrea",
	'ES' => "Spain",
	'ET' => "Ethiopia",
	'EU' => "Europe",
	'FI' => "Finland",
	'FJ' => "Fiji",
	'FK' => "Falkland Islands (Malvinas)",
	'FM' => "Micronesia, Federated States of",
	'FO' => "Faroe Islands",
	'FR' => "France",
	'GA' => "Gabon",
	'GB' => "United Kingdom",
	'GD' => "Grenada",
	'GE' => "Georgia",
	'GF' => "French Guiana",
	'GG' => "Guernsey",
	'GH' => "Ghana",
	'GI' => "Gibraltar",
	'GL' => "Greenland",
	'GM' => "Gambia",
	'GN' => "Guinea",
	'GP' => "Guadeloupe",
	'GQ' => "Equatorial Guinea",
	'GR' => "Greece",
	'GS' => "South Georgia and the South Sandwich Islands",
	'GT' => "Guatemala",
	'GU' => "Guam",
	'GW' => "Guinea-Bissau",
	'GY' => "Guyana",
	'HK' => "Hong Kong",
	'HM' => "Heard Island and McDonald Islands",
	'HN' => "Honduras",
	'HR' => "Croatia",
	'HT' => "Haiti",
	'HU' => "Hungary",
	'ID' => "Indonesia",
	'IE' => "Ireland",
	'IL' => "Israel",
	'IM' => "Isle of Man",
	'IN' => "India",
	'IO' => "British Indian Ocean Territory",
	'IQ' => "Iraq",
	'IR' => "Iran, Islamic Republic of",
	'IS' => "Iceland",
	'IT' => "Italy",
	'JE' => "Jersey",
	'JM' => "Jamaica",
	'JO' => "Jordan",
	'JP' => "Japan",
	'KE' => "Kenya",
	'KG' => "Kyrgyzstan",
	'KH' => "Cambodia",
	'KI' => "Kiribati",
	'KM' => "Comoros",
	'KN' => "Saint Kitts and Nevis",
	'KP' => "Korea, Democratic People's Republic of",
	'KR' => "Korea, Republic of",
	'KW' => "Kuwait",
	'KY' => "Cayman Islands",
	'KZ' => "Kazakhstan",
	'LA' => "Lao People's Democratic Republic",
	'LB' => "Lebanon",
	'LC' => "Saint Lucia",
	'LI' => "Liechtenstein",
	'LK' => "Sri Lanka",
	'LR' => "Liberia",
	'LS' => "Lesotho",
	'LT' => "Lithuania",
	'LU' => "Luxembourg",
	'LV' => "Latvia",
	'LY' => "Libyan Arab Jamahiriya",
	'MA' => "Morocco",
	'MC' => "Monaco",
	'MD' => "Moldova, Republic of",
	'ME' => "Montenegro",
	'MF' => "Saint Martin",
	'MG' => "Madagascar",
	'MH' => "Marshall Islands",
	'MK' => "Macedonia",
	'ML' => "Mali",
	'MM' => "Myanmar",
	'MN' => "Mongolia",
	'MO' => "Macao",
	'MP' => "Northern Mariana Islands",
	'MQ' => "Martinique",
	'MR' => "Mauritania",
	'MS' => "Montserrat",
	'MT' => "Malta",
	'MU' => "Mauritius",
	'MV' => "Maldives",
	'MW' => "Malawi",
	'MX' => "Mexico",
	'MY' => "Malaysia",
	'MZ' => "Mozambique",
	'NA' => "Namibia",
	'NC' => "New Caledonia",
	'NE' => "Niger",
	'NF' => "Norfolk Island",
	'NG' => "Nigeria",
	'NI' => "Nicaragua",
	'NL' => "Netherlands",
	'NO' => "Norway",
	'NP' => "Nepal",
	'NR' => "Nauru",
	'NU' => "Niue",
	'NZ' => "New Zealand",
	'OM' => "Oman",
	'PA' => "Panama",
	'PE' => "Peru",
	'PF' => "French Polynesia",
	'PG' => "Papua New Guinea",
	'PH' => "Philippines",
	'PK' => "Pakistan",
	'PL' => "Poland",
	'PM' => "Saint Pierre and Miquelon",
	'PN' => "Pitcairn",
	'PR' => "Puerto Rico",
	'PS' => "Palestinian Territory",
	'PT' => "Portugal",
	'PW' => "Palau",
	'PY' => "Paraguay",
	'QA' => "Qatar",
	'RE' => "Reunion",
	'RO' => "Romania",
	'RS' => "Serbia",
	'RU' => "Russian Federation",
	'RW' => "Rwanda",
	'SA' => "Saudi Arabia",
	'SB' => "Solomon Islands",
	'SC' => "Seychelles",
	'SD' => "Sudan",
	'SE' => "Sweden",
	'SG' => "Singapore",
	'SH' => "Saint Helena",
	'SI' => "Slovenia",
	'SJ' => "Svalbard and Jan Mayen",
	'SK' => "Slovakia",
	'SL' => "Sierra Leone",
	'SM' => "San Marino",
	'SN' => "Senegal",
	'SO' => "Somalia",
	'SR' => "Suriname",
	'ST' => "Sao Tome and Principe",
	'SV' => "El Salvador",
	'SX' => "Sint Maarten",
	'SY' => "Syrian Arab Republic",
	'SZ' => "Swaziland",
	'TC' => "Turks and Caicos Islands",
	'TD' => "Chad",
	'TF' => "French Southern Territories",
	'TG' => "Togo",
	'TH' => "Thailand",
	'TJ' => "Tajikistan",
	'TK' => "Tokelau",
	'TL' => "Timor-Leste",
	'TM' => "Turkmenistan",
	'TN' => "Tunisia",
	'TO' => "Tonga",
	'TR' => "Turkey",
	'TT' => "Trinidad and Tobago",
	'TV' => "Tuvalu",
	'TW' => "Taiwan",
	'TZ' => "Tanzania, United Republic of",
	'UA' => "Ukraine",
	'UG' => "Uganda",
	'UM' => "United States Minor Outlying Islands",
	'US' => "United States",
	'UY' => "Uruguay",
	'UZ' => "Uzbekistan",
	'VA' => "Holy See (Vatican City State)",
	'VC' => "Saint Vincent and the Grenadines",
	'VE' => "Venezuela",
	'VG' => "Virgin Islands, British",
	'VI' => "Virgin Islands, U.S.",
	'VN' => "Vietnam",
	'VU' => "Vanuatu",
	'WF' => "Wallis and Futuna",
	'WS' => "Samoa",
	'YE' => "Yemen",
	'YT' => "Mayotte",
	'ZA' => "South Africa",
	'ZM' => "Zambia",
	'ZW' => "Zimbabwe"
	);	
	
	
	
    public function __construct()
    {
		$database = dirname(__FILE__).'/firewall.geo.mmdb';

        if (!is_readable($database)) return false;
		
        $this->fileHandle = @fopen($database, 'rb');
        if ($this->fileHandle === false) return false;
		
        $this->fileSize = @filesize($database);
        if ($this->fileSize === false) return false;

        $start = $this->findMetadataStart($database);
        $this->decoderFunc($this->fileHandle, $start);
        list($metadataArray) = $this->decode($start);
        $this->metadata = $this->setMetaData($metadataArray);
        $this->decoder = $this->decoderFunc(
            $this->fileHandle,
            $this->metadata->searchTreeSize + self::$DATA_SECTION_SEPARATOR_SIZE
        );
    }

	public function getNameByCountryCode($code){
		if(isset($this->map[$code])){
			return $this->map[$code];
		} else {
			return '';
		}
	}	


    public function getCountryByIP($ipAddress)
    {
        if (strpos($this->metadata()->databaseType, 'Country') === false) return false;
        $record = $this->get($ipAddress);
        if ($record === null) return false;
        if (!is_array($record)) return false;

        return $record['country']['iso_code'];
    }
	
    public function get($ipAddress)
    {
        if (func_num_args() !== 1) return false;

        if (!is_resource($this->fileHandle)) return false;

        if (!filter_var($ipAddress, FILTER_VALIDATE_IP)) return false;

        if ($this->metadata->ipVersion === 4 && strrpos($ipAddress, ':')) return false;
        $pointer = $this->findAddressInTree($ipAddress);
        if ($pointer === 0) {
            return null;
        }

        return $this->resolveDataPointer($pointer);
    }

    private function findAddressInTree($ipAddress)
    {
        $rawAddress = array_merge(unpack('C*', inet_pton($ipAddress)));

        $bitCount = count($rawAddress) * 8;

        $node = $this->startNode($bitCount);

        for ($i = 0; $i < $bitCount; $i++) {
            if ($node >= $this->metadata->nodeCount) {
                break;
            }
            $tempBit = 0xFF & $rawAddress[$i >> 3];
            $bit = 1 & ($tempBit >> 7 - ($i % 8));

            $node = $this->readNode($node, $bit);
        }
        if ($node === $this->metadata->nodeCount) {
            return 0;
        } elseif ($node > $this->metadata->nodeCount) {
            return $node;
        }
        return false;
    }

    private function startNode($length)
    {

        if ($this->metadata->ipVersion === 6 && $length === 32) {
            return $this->ipV4StartNode();
        }

        return 0;
    }

    private function ipV4StartNode()
    {

        if ($this->metadata->ipVersion === 4) {
            return 0;
        }

        if ($this->ipV4Start) {
            return $this->ipV4Start;
        }
        $node = 0;

        for ($i = 0; $i < 96 && $node < $this->metadata->nodeCount; $i++) {
            $node = $this->readNode($node, 0);
        }
        $this->ipV4Start = $node;

        return $node;
    }

    private function readNode($nodeNumber, $index)
    {
        $baseOffset = $nodeNumber * $this->metadata->nodeByteSize;

        switch ($this->metadata->recordSize) {
            case 24:
                $bytes = $this->read($this->fileHandle, $baseOffset + $index * 3, 3);
                list(, $node) = unpack('N', "\x00" . $bytes);

                return $node;
            case 28:
                $middleByte = $this->read($this->fileHandle, $baseOffset + 3, 1);
                list(, $middle) = unpack('C', $middleByte);
                if ($index === 0) {
                    $middle = (0xF0 & $middle) >> 4;
                } else {
                    $middle = 0x0F & $middle;
                }
                $bytes = $this->read($this->fileHandle, $baseOffset + $index * 4, 3);
                list(, $node) = unpack('N', chr($middle) . $bytes);

                return $node;
            case 32:
                $bytes = $this->read($this->fileHandle, $baseOffset + $index * 4, 4);
                list(, $node) = unpack('N', $bytes);

                return $node;
            default:
                return false;
        }
    }

    private function resolveDataPointer($pointer)
    {
        $resolved = $pointer - $this->metadata->nodeCount
            + $this->metadata->searchTreeSize;
        if ($resolved > $this->fileSize) return false;

        list($data) = $this->decode($resolved);

        return $data;
    }

    private function findMetadataStart($filename)
    {
        $handle = $this->fileHandle;
        $fstat = fstat($handle);
        $fileSize = $fstat['size'];
        $marker = self::$METADATA_START_MARKER;
        $markerLength = self::$METADATA_START_MARKER_LENGTH;
        $metadataMaxLengthExcludingMarker
            = min(self::$METADATA_MAX_SIZE, $fileSize) - $markerLength;

        for ($i = 0; $i <= $metadataMaxLengthExcludingMarker; $i++) {
            for ($j = 0; $j < $markerLength; $j++) {
                fseek($handle, $fileSize - $i - $j - 1);
                $matchBit = fgetc($handle);
                if ($matchBit !== $marker[$markerLength - $j - 1]) {
                    continue 2;
                }
            }

            return $fileSize - $i;
        }
        return false;
    }

    public function metadata()
    {
        if (func_num_args()) return false;
        if (!is_resource($this->fileHandle)) return false;

        return $this->metadata;
    }

    public function close()
    {
        if (!is_resource($this->fileHandle)) return false;
        fclose($this->fileHandle);
    }
	


    public function setMetaData($metadata)
    {
        $this->metadata = new stdclass();
        $this->metadata->binaryFormatMajorVersion = $metadata['binary_format_major_version'];
        $this->metadata->binaryFormatMinorVersion = $metadata['binary_format_minor_version'];
        $this->metadata->buildEpoch = $metadata['build_epoch'];
        $this->metadata->databaseType = $metadata['database_type'];
        $this->metadata->languages = $metadata['languages'];
        $this->metadata->description = $metadata['description'];
        $this->metadata->ipVersion = $metadata['ip_version'];
        $this->metadata->nodeCount = $metadata['node_count'];
        $this->metadata->recordSize = $metadata['record_size'];
        $this->metadata->nodeByteSize = $this->metadata->recordSize / 4;
        $this->metadata->searchTreeSize = $this->metadata->nodeCount * $this->metadata->nodeByteSize;
		return $this->metadata;
    }

    public function read($stream, $offset, $numberOfBytes)
    {
        if ($numberOfBytes === 0) {
            return '';
        }
        if (fseek($stream, $offset) === 0) {
            $value = fread($stream, $numberOfBytes);

            if (ftell($stream) - $offset === $numberOfBytes) {
                return $value;
            }
        }
        return false;
    }

    public function decoderFunc(
        $fileStream,
        $pointerBase = 0,
        $pointerTestHack = false
    ) {
        $this->fileStream = $fileStream;
        $this->pointerBase = $pointerBase;
        $this->pointerTestHack = $pointerTestHack;

        $this->switchByteOrder = $this->isPlatformLittleEndian();
    }

    public function decode($offset)
    {
        list(, $ctrlByte) = unpack(
            'C',
            $this->read($this->fileStream, $offset, 1)
        );
        $offset++;

        $type = $this->types[$ctrlByte >> 5];

        if ($type === 'pointer') {
            list($pointer, $offset) = $this->decodePointer($ctrlByte, $offset);

            // for unit testing
            if ($this->pointerTestHack) {
                return array($pointer);
            }

            list($result) = $this->decode($pointer);

            return array($result, $offset);
        }

        if ($type === 'extended') {
            list(, $nextByte) = unpack(
                'C',
                $this->read($this->fileStream, $offset, 1)
            );

            $typeNum = $nextByte + 7;

            if ($typeNum < 8) return false;

            $type = $this->types[$typeNum];
            $offset++;
        }

        list($size, $offset) = $this->sizeFromCtrlByte($ctrlByte, $offset);

        return $this->decodeByType($type, $offset, $size);
    }

    private function decodeByType($type, $offset, $size)
    {
        switch ($type) {
            case 'map':
                return $this->decodeMap($size, $offset);
            case 'array':
                return $this->decodeArray($size, $offset);
            case 'boolean':
                return array($this->decodeBoolean($size), $offset);
        }

        $newOffset = $offset + $size;
        $bytes = $this->read($this->fileStream, $offset, $size);
        switch ($type) {
            case 'utf8_string':
                return array($this->decodeString($bytes), $newOffset);
            case 'double':
                $this->verifySize(8, $size);

                return array($this->decodeDouble($bytes), $newOffset);
            case 'float':
                $this->verifySize(4, $size);

                return array($this->decodeFloat($bytes), $newOffset);
            case 'bytes':
                return array($bytes, $newOffset);
            case 'uint16':
            case 'uint32':
                return array($this->decodeUint($bytes), $newOffset);
            case 'int32':
                return array($this->decodeInt32($bytes), $newOffset);
            case 'uint64':
            case 'uint128':
                return array($this->decodeBigUint($bytes, $size), $newOffset);
            default:
                return false;
        }
    }

    private function verifySize($expected, $actual)
    {
        if ($expected !== $actual) return false;
    }

    private function decodeArray($size, $offset)
    {
        $array = array();

        for ($i = 0; $i < $size; $i++) {
            list($value, $offset) = $this->decode($offset);
            array_push($array, $value);
        }

        return array($array, $offset);
    }

    private function decodeBoolean($size)
    {
        return $size === 0 ? false : true;
    }

    private function decodeDouble($bits)
    {
        // XXX - Assumes IEEE 754 double on platform
        list(, $double) = unpack('d', $this->maybeSwitchByteOrder($bits));

        return $double;
    }

    private function decodeFloat($bits)
    {
        // XXX - Assumes IEEE 754 floats on platform
        list(, $float) = unpack('f', $this->maybeSwitchByteOrder($bits));

        return $float;
    }

    private function decodeInt32($bytes)
    {
        $bytes = $this->zeroPadLeft($bytes, 4);
        list(, $int) = unpack('l', $this->maybeSwitchByteOrder($bytes));

        return $int;
    }

    private function decodeMap($size, $offset)
    {
        $map = array();

        for ($i = 0; $i < $size; $i++) {
            list($key, $offset) = $this->decode($offset);
            list($value, $offset) = $this->decode($offset);
            $map[$key] = $value;
        }

        return array($map, $offset);
    }

    private $pointerValueOffset = array(
        1 => 0,
        2 => 2048,
        3 => 526336,
        4 => 0,
    );

    private function decodePointer($ctrlByte, $offset)
    {
        $pointerSize = (($ctrlByte >> 3) & 0x3) + 1;

        $buffer = $this->read($this->fileStream, $offset, $pointerSize);
        $offset = $offset + $pointerSize;

        $packed = $pointerSize === 4
            ? $buffer
            : (pack('C', $ctrlByte & 0x7)) . $buffer;

        $unpacked = $this->decodeUint($packed);
        $pointer = $unpacked + $this->pointerBase
            + $this->pointerValueOffset[$pointerSize];

        return array($pointer, $offset);
    }

    private function decodeUint($bytes)
    {
        list(, $int) = unpack('N', $this->zeroPadLeft($bytes, 4));

        return $int;
    }

    private function decodeBigUint($bytes, $byteLength)
    {
        $maxUintBytes = log(PHP_INT_MAX, 2) / 8;

        if ($byteLength === 0) {
            return 0;
        }

        $numberOfLongs = ceil($byteLength / 4);
        $paddedLength = $numberOfLongs * 4;
        $paddedBytes = $this->zeroPadLeft($bytes, $paddedLength);
        $unpacked = array_merge(unpack("N$numberOfLongs", $paddedBytes));

        $integer = 0;

        $twoTo32 = '4294967296';

        foreach ($unpacked as $part) {
            if ($byteLength <= $maxUintBytes) {
                $integer = ($integer << 32) + $part;
            } elseif (extension_loaded('gmp')) {
                $integer = gmp_strval(gmp_add(gmp_mul($integer, $twoTo32), $part));
            } elseif (extension_loaded('bcmath')) {
                $integer = bcadd(bcmul($integer, $twoTo32), $part);
            } else return false;
        }

        return $integer;
    }

    private function decodeString($bytes)
    {
        return $bytes;
    }

    private function sizeFromCtrlByte($ctrlByte, $offset)
    {
        $size = $ctrlByte & 0x1f;
        $bytesToRead = $size < 29 ? 0 : $size - 28;
        $bytes = $this->read($this->fileStream, $offset, $bytesToRead);
        $decoded = $this->decodeUint($bytes);

        if ($size === 29) {
            $size = 29 + $decoded;
        } elseif ($size === 30) {
            $size = 285 + $decoded;
        } elseif ($size > 30) {
            $size = ($decoded & (0x0FFFFFFF >> (32 - (8 * $bytesToRead))))
                + 65821;
        }

        return array($size, $offset + $bytesToRead);
    }

    private function zeroPadLeft($content, $desiredLength)
    {
        return str_pad($content, $desiredLength, "\x00", STR_PAD_LEFT);
    }

    private function maybeSwitchByteOrder($bytes)
    {
        return $this->switchByteOrder ? strrev($bytes) : $bytes;
    }

    private function isPlatformLittleEndian()
    {
        $testint = 0x00FF;
        $packed = pack('S', $testint);

        return $testint === current(unpack('v', $packed));
    }

    public function BlockPage($myIP, $country_name = '')
    {
        ?><html><head>
        </head>
        <body>
        <div style="margin:100px auto; max-width: 500px;text-align: center;">
            <p><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxOS4yLjEsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0i0KHQu9C+0LlfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAyNjk2LjQgNjI0LjMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDI2OTYuNCA2MjQuMzsiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCgkuc3Qwe2ZpbGw6I0FEMTcyNTt9DQoJLnN0MXtmaWxsOiM1NzhCMzg7fQ0KPC9zdHlsZT4NCjxnPg0KCTxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0zMjAuNywzMjYuMWwtMTg4LjEsNTkuMWMtMjYsOC4yLTQ3LTcuMy00Ny0zNC41VjIzNS42YzAtMjcuMiwyMS4xLTU1LjksNDctNjQuMUw1MjcuOSw0Ny4yDQoJCWMtNC42LTEzLjItOC0yMC42LTgtMjAuNkMzNTEuNSw1MS4zLDI3NS41LDAsMjc1LjUsMHMtNzYsNTEuMy0yNDQuNCwyNi43YzAsMC0xMDguMiwyMzAuOCw3OC44LDQ1NS43bDIxMC43LTY2LjJMMzIwLjcsMzI2LjENCgkJTDMyMC43LDMyNi4xeiIvPg0KCTxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik0yMDguOCwyNjYuMUwzOTYuOSwyMDdjMjYtOC4yLDQ3LDcuMyw0NywzNC41djEyMC45YzAsMjcuMi0yMS4xLDU1LjktNDcsNjQuMWwtMjYzLjEsODIuNw0KCQljMzcsMzkuMyw4My4zLDc4LjEsMTQxLjcsMTE1LjFDNTg0LjIsNDI4LjQsNTY0LjEsMTgzLjcsNTM3LjIsNzguNkwyMDguOCwxODEuOVYyNjYuMXoiLz4NCjwvZz4NCjxnPg0KCTxwYXRoIGQ9Ik03NzEuMSwyODAuM2MxMS43LDcuMiwyOC44LDEzLjIsNDYuOCwxMy4yYzI2LjcsMCw0Mi4zLTE0LjEsNDIuMy0zNC41YzAtMTguOS0xMC44LTI5LjctMzguMS00MC4yDQoJCWMtMzMtMTEuNy01My40LTI4LjgtNTMuNC01Ny4zYzAtMzEuNSwyNi4xLTU0LjksNjUuNC01NC45YzIwLjcsMCwzNS43LDQuOCw0NC43LDkuOWwtNy4yLDIxLjNjLTYuNi0zLjYtMjAuMS05LjYtMzguNC05LjYNCgkJYy0yNy42LDAtMzguMSwxNi41LTM4LjEsMzAuM2MwLDE4LjksMTIuMywyOC4yLDQwLjIsMzljMzQuMiwxMy4yLDUxLjYsMjkuNyw1MS42LDU5LjRjMCwzMS4yLTIzLjEsNTguMi03MC44LDU4LjINCgkJYy0xOS41LDAtNDAuOC01LjctNTEuNi0xMi45TDc3MS4xLDI4MC4zeiIvPg0KCTxwYXRoIGQ9Ik05NTEuMSwxMjYuMWMwLjMsOS02LjMsMTYuMi0xNi44LDE2LjJjLTkuMywwLTE1LjktNy4yLTE1LjktMTYuMmMwLTkuMyw2LjktMTYuNSwxNi41LTE2LjUNCgkJQzk0NC44LDEwOS42LDk1MS4xLDExNi44LDk1MS4xLDEyNi4xeiBNOTIxLjcsMzEyLjFWMTY2LjloMjYuNHYxNDUuMkw5MjEuNywzMTIuMUw5MjEuNywzMTIuMXoiLz4NCgk8cGF0aCBkPSJNMTAyMy43LDEyNS4ydjQxLjdoMzcuOFYxODdoLTM3Ljh2NzguM2MwLDE4LDUuMSwyOC4yLDE5LjgsMjguMmM2LjksMCwxMi0wLjksMTUuMy0xLjhsMS4yLDE5LjgNCgkJYy01LjEsMi4xLTEzLjIsMy42LTIzLjQsMy42Yy0xMi4zLDAtMjIuMi0zLjktMjguNS0xMS4xYy03LjUtNy44LTEwLjItMjAuNy0xMC4yLTM3LjhWMTg3aC0yMi41di0yMC4xaDIyLjV2LTM0LjhMMTAyMy43LDEyNS4yeiINCgkJLz4NCgk8cGF0aCBkPSJNMTEwNC4xLDI0NC4zYzAuNiwzNS43LDIzLjQsNTAuNCw0OS44LDUwLjRjMTguOSwwLDMwLjMtMy4zLDQwLjItNy41bDQuNSwxOC45Yy05LjMsNC4yLTI1LjIsOS00OC4zLDkNCgkJYy00NC43LDAtNzEuNC0yOS40LTcxLjQtNzMuMnMyNS44LTc4LjMsNjguMS03OC4zYzQ3LjQsMCw2MCw0MS43LDYwLDY4LjRjMCw1LjQtMC42LDkuNi0wLjksMTIuM0wxMTA0LjEsMjQ0LjNMMTEwNC4xLDI0NC4zeg0KCQkgTTExODEuNSwyMjUuNGMwLjMtMTYuOC02LjktNDIuOS0zNi42LTQyLjljLTI2LjcsMC0zOC40LDI0LjYtNDAuNSw0Mi45SDExODEuNXoiLz4NCgk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMTM5NC41LDMwMy4xYy0xMS43LDQuMi0zNC44LDExLjEtNjIuMSwxMS4xYy0zMC42LDAtNTUuOC03LjgtNzUuNi0yNi43Yy0xNy40LTE2LjgtMjguMi00My44LTI4LjItNzUuMw0KCQljMC4zLTYwLjMsNDEuNy0xMDQuNCwxMDkuNS0xMDQuNGMyMy40LDAsNDEuNyw1LjEsNTAuNCw5LjNsLTYuMywyMS4zYy0xMC44LTQuOC0yNC4zLTguNy00NC43LTguN2MtNDkuMiwwLTgxLjMsMzAuNi04MS4zLDgxLjMNCgkJYzAsNTEuMywzMC45LDgxLjYsNzgsODEuNmMxNy4xLDAsMjguOC0yLjQsMzQuOC01LjR2LTYwLjNoLTQxLjF2LTIxaDY2LjZMMTM5NC41LDMwMy4xTDEzOTQuNSwzMDMuMXoiLz4NCgk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMTU1NSwyNzIuNWMwLDE1LDAuMywyOC4yLDEuMiwzOS42aC0yMy40bC0xLjUtMjMuN2gtMC42Yy02LjksMTEuNy0yMi4yLDI3LTQ4LDI3DQoJCWMtMjIuOCwwLTUwLjEtMTIuNi01MC4xLTYzLjZ2LTg0LjloMjYuNHY4MC40YzAsMjcuNiw4LjQsNDYuMiwzMi40LDQ2LjJjMTcuNywwLDMwLTEyLjMsMzQuOC0yNGMxLjUtMy45LDIuNC04LjcsMi40LTEzLjV2LTg5LjENCgkJaDI2LjRMMTU1NSwyNzIuNUwxNTU1LDI3Mi41eiIvPg0KCTxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik0xNjc5LjIsMzEyLjFsLTIuMS0xOC4zaC0wLjljLTguMSwxMS40LTIzLjcsMjEuNi00NC40LDIxLjZjLTI5LjQsMC00NC40LTIwLjctNDQuNC00MS43DQoJCWMwLTM1LjEsMzEuMi01NC4zLDg3LjMtNTR2LTNjMC0xMi0zLjMtMzMuNi0zMy0zMy42Yy0xMy41LDAtMjcuNiw0LjItMzcuOCwxMC44bC02LTE3LjRjMTItNy44LDI5LjQtMTIuOSw0Ny43LTEyLjkNCgkJYzQ0LjQsMCw1NS4yLDMwLjMsNTUuMiw1OS40djU0LjNjMCwxMi42LDAuNiwyNC45LDIuNCwzNC44TDE2NzkuMiwzMTIuMUwxNjc5LjIsMzEyLjF6IE0xNjc1LjMsMjM4Yy0yOC44LTAuNi02MS41LDQuNS02MS41LDMyLjcNCgkJYzAsMTcuMSwxMS40LDI1LjIsMjQuOSwyNS4yYzE4LjksMCwzMC45LTEyLDM1LjEtMjQuM2MwLjktMi43LDEuNS01LjcsMS41LTguNFYyMzh6Ii8+DQoJPHBhdGggY2xhc3M9InN0MSIgZD0iTTE3NDMuNCwyMTIuMmMwLTE3LjEtMC4zLTMxLjgtMS4yLTQ1LjNoMjMuMWwwLjksMjguNWgxLjJjNi42LTE5LjUsMjIuNS0zMS44LDQwLjItMzEuOGMzLDAsNS4xLDAuMyw3LjUsMC45DQoJCXYyNC45Yy0yLjctMC42LTUuNC0wLjktOS0wLjljLTE4LjYsMC0zMS44LDE0LjEtMzUuNCwzMy45Yy0wLjYsMy42LTEuMiw3LjgtMS4yLDEyLjN2NzcuNGgtMjYuMVYyMTIuMnoiLz4NCgk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMTk2My45LDk5LjF2MTc1LjVjMCwxMi45LDAuMywyNy42LDEuMiwzNy41aC0yMy43bC0xLjItMjUuMmgtMC42Yy04LjEsMTYuMi0yNS44LDI4LjUtNDkuNSwyOC41DQoJCWMtMzUuMSwwLTYyLjEtMjkuNy02Mi4xLTczLjhjLTAuMy00OC4zLDI5LjctNzgsNjUuMS03OGMyMi4yLDAsMzcuMiwxMC41LDQzLjgsMjIuMmgwLjZWOTkuMUgxOTYzLjl6IE0xOTM3LjUsMjI2DQoJCWMwLTMuMy0wLjMtNy44LTEuMi0xMS4xYy0zLjktMTYuOC0xOC4zLTMwLjYtMzguMS0zMC42Yy0yNy4zLDAtNDMuNSwyNC00My41LDU2LjFjMCwyOS40LDE0LjQsNTMuNyw0Mi45LDUzLjcNCgkJYzE3LjcsMCwzMy45LTExLjcsMzguNy0zMS41YzAuOS0zLjYsMS4yLTcuMiwxLjItMTEuNFYyMjZ6Ii8+DQoJPHBhdGggY2xhc3M9InN0MSIgZD0iTTIwMzcuMSwxMjYuMWMwLjMsOS02LjMsMTYuMi0xNi44LDE2LjJjLTkuMywwLTE1LjktNy4yLTE1LjktMTYuMmMwLTkuMyw2LjktMTYuNSwxNi41LTE2LjUNCgkJQzIwMzAuOCwxMDkuNiwyMDM3LjEsMTE2LjgsMjAzNy4xLDEyNi4xeiBNMjAwNy43LDMxMi4xVjE2Ni45aDI2LjR2MTQ1LjJMMjAwNy43LDMxMi4xTDIwMDcuNywzMTIuMXoiLz4NCgk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMjA3Ny45LDIwNi4yYzAtMTUtMC4zLTI3LjMtMS4yLTM5LjNoMjMuNGwxLjUsMjRoMC42YzcuMi0xMy44LDI0LTI3LjMsNDgtMjcuM2MyMC4xLDAsNTEuMywxMiw1MS4zLDYxLjgNCgkJdjg2LjdoLTI2LjR2LTgzLjdjMC0yMy40LTguNy00Mi45LTMzLjYtNDIuOWMtMTcuNCwwLTMwLjksMTIuMy0zNS40LDI3Yy0xLjIsMy4zLTEuOCw3LjgtMS44LDEyLjN2ODcuM2gtMjYuNEwyMDc3LjksMjA2LjINCgkJTDIwNzcuOSwyMDYuMnoiLz4NCgk8cGF0aCBjbGFzcz0ic3QxIiBkPSJNMjM2OS41LDE2Ni45Yy0wLjYsMTAuNS0xLjIsMjIuMi0xLjIsMzkuOXY4NC4zYzAsMzMuMy02LjYsNTMuNy0yMC43LDY2LjNjLTE0LjEsMTMuMi0zNC41LDE3LjQtNTIuOCwxNy40DQoJCWMtMTcuNCwwLTM2LjYtNC4yLTQ4LjMtMTJsNi42LTIwLjFjOS42LDYsMjQuNiwxMS40LDQyLjYsMTEuNGMyNywwLDQ2LjgtMTQuMSw0Ni44LTUwLjd2LTE2LjJoLTAuNmMtOC4xLDEzLjUtMjMuNywyNC4zLTQ2LjIsMjQuMw0KCQljLTM2LDAtNjEuOC0zMC42LTYxLjgtNzAuOGMwLTQ5LjIsMzIuMS03Ny4xLDY1LjQtNzcuMWMyNS4yLDAsMzksMTMuMiw0NS4zLDI1LjJoMC42bDEuMi0yMS45TDIzNjkuNSwxNjYuOUwyMzY5LjUsMTY2Ljl6DQoJCSBNMjM0Mi4yLDIyNC4yYzAtNC41LTAuMy04LjQtMS41LTEyYy00LjgtMTUuMy0xNy43LTI3LjktMzYuOS0yNy45Yy0yNS4yLDAtNDMuMiwyMS4zLTQzLjIsNTQuOWMwLDI4LjUsMTQuNCw1Mi4yLDQyLjksNTIuMg0KCQljMTYuMiwwLDMwLjktMTAuMiwzNi42LTI3YzEuNS00LjUsMi4xLTkuNiwyLjEtMTQuMUwyMzQyLjIsMjI0LjJMMjM0Mi4yLDIyNC4yeiIvPg0KCTxwYXRoIGQ9Ik0yMzk4LDMwNC4zYzAtNS41LDMuOC05LjQsOS05LjRzOC44LDMuOSw4LjgsOS40YzAsNS40LTMuNSw5LjUtOSw5LjVDMjQwMS42LDMxMy44LDIzOTgsMzA5LjcsMjM5OCwzMDQuM3oiLz4NCgk8cGF0aCBkPSJNMjQ4My45LDMwOS40Yy0zLjQsMS44LTExLjEsNC4yLTIwLjgsNC4yYy0yMS45LDAtMzYuMS0xNC44LTM2LjEtMzdjMC0yMi4zLDE1LjMtMzguNSwzOS0zOC41YzcuOCwwLDE0LjcsMiwxOC4zLDMuOA0KCQlsLTMsMTAuMmMtMy4yLTEuOC04LjEtMy41LTE1LjMtMy41Yy0xNi42LDAtMjUuNiwxMi4zLTI1LjYsMjcuNGMwLDE2LjgsMTAuOCwyNy4xLDI1LjIsMjcuMWM3LjUsMCwxMi40LTIsMTYuMi0zLjZMMjQ4My45LDMwOS40eiINCgkJLz4NCgk8cGF0aCBkPSJNMjU2NC4yLDI3NS4yYzAsMjYuOC0xOC42LDM4LjUtMzYuMSwzOC41Yy0xOS42LDAtMzQuOC0xNC40LTM0LjgtMzcuM2MwLTI0LjMsMTUuOS0zOC41LDM2LTM4LjUNCgkJQzI1NTAuMSwyMzcuOSwyNTY0LjIsMjUzLDI1NjQuMiwyNzUuMnogTTI1MDYuNiwyNzZjMCwxNS45LDkuMiwyNy45LDIyLDI3LjljMTIuNiwwLDIyLTExLjgsMjItMjguMmMwLTEyLjMtNi4xLTI3LjktMjEuNy0yNy45DQoJCVMyNTA2LjYsMjYyLjIsMjUwNi42LDI3NnoiLz4NCgk8cGF0aCBkPSJNMjU4MC44LDI1OS4yYzAtNy41LTAuMS0xMy42LTAuNi0xOS42aDExLjVsMC42LDExLjdoMC41YzQtNi45LDEwLjgtMTMuMywyMi44LTEzLjNjOS45LDAsMTcuNCw2LDIwLjUsMTQuNWgwLjMNCgkJYzIuMy00LDUuMS03LjIsOC4xLTkuNGM0LjMtMy4zLDkuMS01LjEsMTYtNS4xYzkuNiwwLDIzLjgsNi4zLDIzLjgsMzEuNXY0Mi43aC0xMi45VjI3MWMwLTEzLjktNS4xLTIyLjMtMTUuOC0yMi4zDQoJCWMtNy41LDAtMTMuMyw1LjUtMTUuNiwxMmMtMC42LDEuOC0xLDQuMi0xLDYuNnY0NC44aC0xMi45di00My41YzAtMTEuNS01LjEtMTkuOS0xNS4xLTE5LjljLTguMiwwLTE0LjIsNi42LTE2LjMsMTMuMg0KCQljLTAuOCwyLTEuMSw0LjItMS4xLDYuNHY0My44aC0xMi45TDI1ODAuOCwyNTkuMkwyNTgwLjgsMjU5LjJ6Ii8+DQo8L2c+DQo8Zz4NCgk8cGF0aCBkPSJNNzYwLjUsNDI1LjRjNC43LTAuOCwxMS0xLjUsMTguOS0xLjVjOS43LDAsMTYuOCwyLjMsMjEuNCw2LjNjNC4yLDMuNiw2LjcsOS4yLDYuNywxNS45YzAsNi45LTIsMTIuMy01LjksMTYuMw0KCQljLTUuMiw1LjUtMTMuNyw4LjQtMjMuMyw4LjRjLTIuOSwwLTUuNy0wLjEtNy45LTAuN3YzMC41aC05Ljh2LTc1LjJINzYwLjV6IE03NzAuMyw0NjIuMmMyLjEsMC42LDQuOSwwLjgsOC4xLDAuOA0KCQljMTEuOSwwLDE5LjEtNS44LDE5LjEtMTYuM2MwLTEwLjEtNy4xLTE0LjktMTgtMTQuOWMtNC4zLDAtNy42LDAuMy05LjMsMC44djI5LjZINzcwLjN6Ii8+DQoJPHBhdGggZD0iTTgxOC40LDQ2My4xYzAtNi40LTAuMS0xMi0wLjUtMTcuMWg4LjdsMC4zLDEwLjdoMC41YzIuNS03LjMsOC41LTEyLDE1LjEtMTJjMS4xLDAsMS45LDAuMSwyLjgsMC4zdjkuNA0KCQljLTEtMC4yLTItMC4zLTMuNC0wLjNjLTcsMC0xMiw1LjMtMTMuMywxMi44Yy0wLjIsMS40LTAuNSwyLjktMC41LDQuNnYyOS4yaC05LjdWNDYzLjF6Ii8+DQoJPHBhdGggZD0iTTkwMy44LDQ3Mi45YzAsMjAuMi0xNCwyOS0yNy4yLDI5Yy0xNC44LDAtMjYuMi0xMC44LTI2LjItMjguMWMwLTE4LjMsMTItMjksMjcuMS0yOUM4OTMuMSw0NDQuNyw5MDMuOCw0NTYuMiw5MDMuOCw0NzIuOQ0KCQl6IE04NjAuNCw0NzMuNWMwLDEyLDYuOSwyMSwxNi42LDIxYzkuNSwwLDE2LjYtOC45LDE2LjYtMjEuMmMwLTkuMy00LjYtMjEtMTYuNC0yMUM4NjUuNCw0NTIuMiw4NjAuNCw0NjMuMSw4NjAuNCw0NzMuNXoiLz4NCgk8cGF0aCBkPSJNOTE3LjMsNTAwLjd2LTQ3LjFoLTcuN1Y0NDZoNy43di0yLjZjMC03LjcsMS43LTE0LjcsNi4zLTE5LjFjMy43LTMuNiw4LjctNS4xLDEzLjMtNS4xYzMuNSwwLDYuNiwwLjgsOC41LDEuNmwtMS40LDcuNw0KCQljLTEuNS0wLjctMy41LTEuMi02LjMtMS4yYy04LjUsMC0xMC42LDcuNS0xMC42LDE1Ljh2Mi45aDEzLjJ2Ny42aC0xMy4ydjQ3LjFMOTE3LjMsNTAwLjdMOTE3LjMsNTAwLjd6Ii8+DQoJPHBhdGggZD0iTTk1My40LDQ3NS4xYzAuMiwxMy40LDguOCwxOSwxOC44LDE5YzcuMSwwLDExLjQtMS4yLDE1LjEtMi44bDEuNyw3LjFjLTMuNSwxLjYtOS41LDMuNC0xOC4yLDMuNA0KCQljLTE2LjgsMC0yNi45LTExLjEtMjYuOS0yNy42czkuNy0yOS41LDI1LjctMjkuNWMxNy45LDAsMjIuNiwxNS43LDIyLjYsMjUuOGMwLDItMC4yLDMuNi0wLjMsNC42SDk1My40eiBNOTgyLjUsNDY4DQoJCWMwLjEtNi4zLTIuNi0xNi4yLTEzLjgtMTYuMmMtMTAuMSwwLTE0LjUsOS4zLTE1LjMsMTYuMkg5ODIuNXoiLz4NCgk8cGF0aCBkPSJNMTAwMy4xLDQ5MC41YzIuOSwxLjksOC4xLDQsMTMuMSw0YzcuMiwwLDEwLjYtMy42LDEwLjYtOC4xYzAtNC43LTIuOC03LjMtMTAuMi0xMC4xYy05LjgtMy41LTE0LjUtOC45LTE0LjUtMTUuNQ0KCQljMC04LjgsNy4xLTE2LDE4LjktMTZjNS41LDAsMTAuNCwxLjYsMTMuNCwzLjRsLTIuNSw3LjJjLTIuMS0xLjQtNi4xLTMuMi0xMS4yLTMuMmMtNS45LDAtOS4yLDMuNC05LjIsNy41YzAsNC41LDMuMyw2LjYsMTAuNCw5LjMNCgkJYzkuNSwzLjYsMTQuNCw4LjQsMTQuNCwxNi41YzAsOS42LTcuNSwxNi40LTIwLjUsMTYuNGMtNiwwLTExLjUtMS41LTE1LjQtMy43TDEwMDMuMSw0OTAuNXoiLz4NCgk8cGF0aCBkPSJNMTA0Ny44LDQ5MC41YzIuOSwxLjksOC4xLDQsMTMuMSw0YzcuMiwwLDEwLjYtMy42LDEwLjYtOC4xYzAtNC43LTIuOC03LjMtMTAuMi0xMC4xYy05LjgtMy41LTE0LjUtOC45LTE0LjUtMTUuNQ0KCQljMC04LjgsNy4xLTE2LDE4LjktMTZjNS41LDAsMTAuNCwxLjYsMTMuNCwzLjRsLTIuNSw3LjJjLTIuMS0xLjQtNi4xLTMuMi0xMS4yLTMuMmMtNS45LDAtOS4yLDMuNC05LjIsNy41YzAsNC41LDMuMyw2LjYsMTAuNCw5LjMNCgkJYzkuNSwzLjYsMTQuNCw4LjQsMTQuNCwxNi41YzAsOS42LTcuNSwxNi40LTIwLjUsMTYuNGMtNiwwLTExLjUtMS41LTE1LjQtMy43TDEwNDcuOCw0OTAuNXoiLz4NCgk8cGF0aCBkPSJNMTEwNSw0MzAuNmMwLjEsMy40LTIuNCw2LjEtNi4zLDYuMWMtMy41LDAtNi0yLjctNi02LjFjMC0zLjUsMi42LTYuMiw2LjItNi4yQzExMDIuNiw0MjQuNCwxMTA1LDQyNy4xLDExMDUsNDMwLjZ6DQoJCSBNMTA5My45LDUwMC43VjQ0Nmg5Ljl2NTQuN0gxMDkzLjl6Ii8+DQoJPHBhdGggZD0iTTExNjkuOSw0NzIuOWMwLDIwLjItMTQsMjktMjcuMiwyOWMtMTQuOCwwLTI2LjItMTAuOC0yNi4yLTI4LjFjMC0xOC4zLDEyLTI5LDI3LjEtMjkNCgkJQzExNTkuMiw0NDQuNywxMTY5LjksNDU2LjIsMTE2OS45LDQ3Mi45eiBNMTEyNi41LDQ3My41YzAsMTIsNi45LDIxLDE2LjYsMjFjOS41LDAsMTYuNi04LjksMTYuNi0yMS4yYzAtOS4zLTQuNi0yMS0xNi40LTIxDQoJCUMxMTMxLjYsNDUyLjIsMTEyNi41LDQ2My4xLDExMjYuNSw0NzMuNXoiLz4NCgk8cGF0aCBkPSJNMTE4Mi40LDQ2MC44YzAtNS43LTAuMS0xMC4zLTAuNS0xNC44aDguOGwwLjYsOWgwLjJjMi43LTUuMiw5LTEwLjMsMTguMS0xMC4zYzcuNiwwLDE5LjMsNC41LDE5LjMsMjMuM3YzMi43aC05Ljl2LTMxLjUNCgkJYzAtOC44LTMuMy0xNi4yLTEyLjctMTYuMmMtNi42LDAtMTEuNiw0LjYtMTMuMywxMC4yYy0wLjUsMS4yLTAuNywyLjktMC43LDQuNnYzMi45aC05LjlWNDYwLjh6Ii8+DQoJPHBhdGggZD0iTTEyNzUuNCw1MDAuN2wtMC44LTYuOWgtMC4zYy0zLjEsNC4zLTguOSw4LjEtMTYuNyw4LjFjLTExLjEsMC0xNi43LTcuOC0xNi43LTE1LjdjMC0xMy4yLDExLjgtMjAuNSwzMi45LTIwLjN2LTEuMQ0KCQljMC00LjUtMS4yLTEyLjctMTIuNC0xMi43Yy01LjEsMC0xMC40LDEuNi0xNC4yLDQuMWwtMi4zLTYuNmM0LjUtMi45LDExLjEtNC45LDE4LTQuOWMxNi43LDAsMjAuOCwxMS40LDIwLjgsMjIuNHYyMC41DQoJCWMwLDQuNywwLjIsOS40LDAuOSwxMy4xSDEyNzUuNHogTTEyNzMuOSw0NzIuOGMtMTAuOC0wLjItMjMuMiwxLjctMjMuMiwxMi4zYzAsNi40LDQuMyw5LjUsOS40LDkuNWM3LjEsMCwxMS42LTQuNSwxMy4yLTkuMg0KCQljMC4zLTEsMC42LTIuMSwwLjYtMy4yVjQ3Mi44eiIvPg0KCTxwYXRoIGQ9Ik0xMjk5LjYsNDIwLjVoOS45djgwLjJoLTkuOVY0MjAuNXoiLz4NCgk8cGF0aCBkPSJNMTM1OC45LDUwMC43bC0xOS4zLTc2LjJoMTAuNGw5LDM4LjVjMi4zLDkuNSw0LjMsMTksNS43LDI2LjNoMC4yYzEuMi03LjYsMy42LTE2LjYsNi4yLTI2LjRsMTAuMi0zOC40aDEwLjNsOS4zLDM4LjYNCgkJYzIuMSw5LDQuMiwxOC4xLDUuMywyNi4xaDAuMmMxLjYtOC40LDMuNy0xNi44LDYuMS0yNi4zbDEwLjEtMzguNGgxMC4xbC0yMS42LDc2LjJoLTEwLjNsLTkuNi0zOS43Yy0yLjQtOS43LTQtMTcuMi01LTI0LjloLTAuMg0KCQljLTEuNCw3LjYtMy4xLDE1LTUuOSwyNC45bC0xMC44LDM5LjdMMTM1OC45LDUwMC43TDEzNTguOSw1MDAuN3oiLz4NCgk8cGF0aCBkPSJNMTQ0My42LDQ3NS4xYzAuMiwxMy40LDguOCwxOSwxOC44LDE5YzcuMSwwLDExLjQtMS4yLDE1LjEtMi44bDEuNyw3LjFjLTMuNSwxLjYtOS41LDMuNC0xOC4yLDMuNA0KCQljLTE2LjgsMC0yNi45LTExLjEtMjYuOS0yNy42czkuNy0yOS41LDI1LjctMjkuNWMxNy45LDAsMjIuNiwxNS43LDIyLjYsMjUuOGMwLDItMC4yLDMuNi0wLjMsNC42SDE0NDMuNnogTTE0NzIuNyw0NjgNCgkJYzAuMS02LjMtMi42LTE2LjItMTMuOC0xNi4yYy0xMC4xLDAtMTQuNSw5LjMtMTUuMywxNi4ySDE0NzIuN3oiLz4NCgk8cGF0aCBkPSJNMTQ5NC4yLDUwMC43YzAuMi0zLjcsMC41LTkuMywwLjUtMTQuMXYtNjYuMWg5Ljh2MzQuNGgwLjJjMy41LTYuMSw5LjgtMTAuMSwxOC42LTEwLjFjMTMuNiwwLDIzLjIsMTEuMywyMy4xLDI3LjkNCgkJYzAsMTkuNS0xMi4zLDI5LjMtMjQuNSwyOS4zYy03LjksMC0xNC4yLTMuMS0xOC4zLTEwLjNoLTAuM2wtMC41LDlMMTQ5NC4yLDUwMC43TDE0OTQuMiw1MDAuN3ogTTE1MDQuNSw0NzguOA0KCQljMCwxLjIsMC4yLDIuNSwwLjUsMy42YzEuOSw2LjksNy43LDExLjYsMTQuOSwxMS42YzEwLjQsMCwxNi42LTguNSwxNi42LTIxYzAtMTEtNS43LTIwLjMtMTYuMy0yMC4zYy02LjgsMC0xMy4xLDQuNi0xNS4xLDEyLjINCgkJYy0wLjIsMS4xLTAuNiwyLjUtMC42LDQuMVY0NzguOHoiLz4NCgk8cGF0aCBkPSJNMTU4MS45LDQ4OC43YzQuNCwyLjcsMTAuOCw1LDE3LjYsNWMxMC4xLDAsMTUuOS01LjMsMTUuOS0xM2MwLTcuMS00LjEtMTEuMi0xNC40LTE1LjFjLTEyLjQtNC40LTIwLjEtMTAuOC0yMC4xLTIxLjYNCgkJYzAtMTEuOSw5LjgtMjAuNywyNC42LTIwLjdjNy44LDAsMTMuNCwxLjgsMTYuOCwzLjdsLTIuNyw4Yy0yLjUtMS40LTcuNi0zLjYtMTQuNS0zLjZjLTEwLjQsMC0xNC40LDYuMi0xNC40LDExLjQNCgkJYzAsNy4xLDQuNiwxMC42LDE1LjEsMTQuN2MxMi45LDUsMTkuNCwxMS4yLDE5LjQsMjIuNGMwLDExLjgtOC43LDIxLjktMjYuNywyMS45Yy03LjMsMC0xNS40LTIuMS0xOS40LTQuOUwxNTgxLjksNDg4Ljd6Ii8+DQoJPHBhdGggZD0iTTE2NDQuOCw0NzUuMWMwLjIsMTMuNCw4LjgsMTksMTguOCwxOWM3LjEsMCwxMS40LTEuMiwxNS4xLTIuOGwxLjcsNy4xYy0zLjUsMS42LTkuNSwzLjQtMTguMiwzLjQNCgkJYy0xNi44LDAtMjYuOS0xMS4xLTI2LjktMjcuNnM5LjctMjkuNSwyNS43LTI5LjVjMTcuOSwwLDIyLjYsMTUuNywyMi42LDI1LjhjMCwyLTAuMiwzLjYtMC4zLDQuNkgxNjQ0Ljh6IE0xNjc0LDQ2OA0KCQljMC4xLTYuMy0yLjYtMTYuMi0xMy44LTE2LjJjLTEwLjEsMC0xNC41LDkuMy0xNS4zLDE2LjJIMTY3NHoiLz4NCgk8cGF0aCBkPSJNMTczNC45LDQ5OC43Yy0yLjYsMS40LTguNCwzLjItMTUuNywzLjJjLTE2LjUsMC0yNy4yLTExLjItMjcuMi0yNy45YzAtMTYuOCwxMS41LTI5LDI5LjQtMjljNS45LDAsMTEuMSwxLjUsMTMuOCwyLjgNCgkJbC0yLjMsNy43Yy0yLjQtMS40LTYuMS0yLjYtMTEuNS0yLjZjLTEyLjUsMC0xOS4zLDkuMy0xOS4zLDIwLjdjMCwxMi43LDguMSwyMC41LDE5LDIwLjVjNS43LDAsOS40LTEuNSwxMi4yLTIuN0wxNzM0LjksNDk4Ljd6Ii8+DQoJPHBhdGggZD0iTTE3OTIuMyw0ODUuOGMwLDUuNywwLjEsMTAuNiwwLjUsMTQuOWgtOC44bC0wLjYtOC45aC0wLjJjLTIuNiw0LjQtOC40LDEwLjItMTguMSwxMC4yYy04LjYsMC0xOC45LTQuNy0xOC45LTI0di0zMmg5LjkNCgkJdjMwLjNjMCwxMC40LDMuMiwxNy40LDEyLjIsMTcuNGM2LjcsMCwxMS4zLTQuNiwxMy4xLTljMC42LTEuNSwwLjktMy4zLDAuOS01LjFWNDQ2aDkuOUwxNzkyLjMsNDg1LjhMMTc5Mi4zLDQ4NS44eiIvPg0KCTxwYXRoIGQ9Ik0xODA4LjgsNDYzLjFjMC02LjQtMC4xLTEyLTAuNS0xNy4xaDguN2wwLjMsMTAuN2gwLjVjMi41LTcuMyw4LjUtMTIsMTUuMS0xMmMxLjEsMCwxLjksMC4xLDIuOCwwLjN2OS40DQoJCWMtMS0wLjItMi0wLjMtMy40LTAuM2MtNywwLTEyLDUuMy0xMy4zLDEyLjhjLTAuMiwxLjQtMC41LDIuOS0wLjUsNC42djI5LjJoLTkuOHYtMzcuNkgxODA4Ljh6Ii8+DQoJPHBhdGggZD0iTTE4NTcuMiw0MzAuNmMwLjEsMy40LTIuNCw2LjEtNi4zLDYuMWMtMy41LDAtNi0yLjctNi02LjFjMC0zLjUsMi42LTYuMiw2LjItNi4yQzE4NTQuOSw0MjQuNCwxODU3LjIsNDI3LjEsMTg1Ny4yLDQzMC42eg0KCQkgTTE4NDYuMiw1MDAuN1Y0NDZoOS45djU0LjdIMTg0Ni4yeiIvPg0KCTxwYXRoIGQ9Ik0xODg0LjYsNDMwLjNWNDQ2aDE0LjJ2Ny42aC0xNC4ydjI5LjVjMCw2LjgsMS45LDEwLjYsNy41LDEwLjZjMi42LDAsNC41LTAuMyw1LjgtMC43bDAuNSw3LjVjLTEuOSwwLjgtNSwxLjQtOC44LDEuNA0KCQljLTQuNiwwLTguNC0xLjUtMTAuNy00LjJjLTIuOC0yLjktMy44LTcuOC0zLjgtMTQuMnYtMjkuOGgtOC41di03LjZoOC41VjQzM0wxODg0LjYsNDMwLjN6Ii8+DQoJPHBhdGggZD0iTTE5MTQuNiw0NDZsMTIsMzIuM2MxLjIsMy42LDIuNiw3LjksMy41LDExLjJoMC4yYzEtMy4zLDIuMS03LjUsMy41LTExLjRsMTAuOC0zMi4xaDEwLjVsLTE0LjksMzkNCgkJYy03LjEsMTguOC0xMiwyOC40LTE4LjgsMzQuMmMtNC45LDQuMy05LjcsNi0xMi4yLDYuNGwtMi41LTguNGMyLjUtMC44LDUuOC0yLjQsOC43LTQuOWMyLjctMi4xLDYuMS02LDguNC0xMS4xDQoJCWMwLjUtMSwwLjgtMS44LDAuOC0yLjRzLTAuMi0xLjQtMC43LTIuNmwtMjAuMi01MC40aDEwLjlWNDQ2eiIvPg0KCTxwYXRoIGQ9Ik0xOTg3LjIsNDg4LjdjNC40LDIuNywxMC44LDUsMTcuNiw1YzEwLjEsMCwxNS45LTUuMywxNS45LTEzYzAtNy4xLTQuMS0xMS4yLTE0LjQtMTUuMWMtMTIuNC00LjQtMjAuMS0xMC44LTIwLjEtMjEuNg0KCQljMC0xMS45LDkuOC0yMC43LDI0LjYtMjAuN2M3LjgsMCwxMy40LDEuOCwxNi44LDMuN2wtMi43LDhjLTIuNS0xLjQtNy42LTMuNi0xNC41LTMuNmMtMTAuNCwwLTE0LjQsNi4yLTE0LjQsMTEuNA0KCQljMCw3LjEsNC42LDEwLjYsMTUuMSwxNC43YzEyLjksNSwxOS40LDExLjIsMTkuNCwyMi40YzAsMTEuOC04LjcsMjEuOS0yNi43LDIxLjljLTcuMywwLTE1LjQtMi4xLTE5LjQtNC45TDE5ODcuMiw0ODguN3oiLz4NCgk8cGF0aCBkPSJNMjA1MC4xLDQ3NS4xYzAuMiwxMy40LDguOCwxOSwxOC44LDE5YzcuMSwwLDExLjQtMS4yLDE1LjEtMi44bDEuNyw3LjFjLTMuNSwxLjYtOS41LDMuNC0xOC4yLDMuNA0KCQljLTE2LjgsMC0yNi45LTExLjEtMjYuOS0yNy42czkuNy0yOS41LDI1LjctMjkuNWMxNy45LDAsMjIuNiwxNS43LDIyLjYsMjUuOGMwLDItMC4yLDMuNi0wLjMsNC42SDIwNTAuMXogTTIwNzkuMyw0NjgNCgkJYzAuMS02LjMtMi42LTE2LjItMTMuOC0xNi4yYy0xMC4xLDAtMTQuNSw5LjMtMTUuMywxNi4ySDIwNzkuM3oiLz4NCgk8cGF0aCBkPSJNMjEwMS4yLDQ2My4xYzAtNi40LTAuMS0xMi0wLjUtMTcuMWg4LjdsMC4zLDEwLjdoMC41YzIuNS03LjMsOC41LTEyLDE1LjEtMTJjMS4xLDAsMS45LDAuMSwyLjgsMC4zdjkuNA0KCQljLTEtMC4yLTItMC4zLTMuNC0wLjNjLTcsMC0xMiw1LjMtMTMuMywxMi44Yy0wLjIsMS40LTAuNSwyLjktMC41LDQuNnYyOS4yaC05LjhMMjEwMS4yLDQ2My4xTDIxMDEuMiw0NjMuMXoiLz4NCgk8cGF0aCBkPSJNMjE0NC44LDQ0NmwxMC43LDMwLjdjMS44LDUsMy4zLDkuNSw0LjQsMTRoMC4zYzEuMi00LjUsMi44LTksNC42LTE0bDEwLjYtMzAuN2gxMC40bC0yMS41LDU0LjdoLTkuNUwyMTM0LDQ0NkgyMTQ0Ljh6Ii8+DQoJPHBhdGggZD0iTTIyMDYuNCw0MzAuNmMwLjEsMy40LTIuNCw2LjEtNi4zLDYuMWMtMy41LDAtNi0yLjctNi02LjFjMC0zLjUsMi42LTYuMiw2LjItNi4yQzIyMDQsNDI0LjQsMjIwNi40LDQyNy4xLDIyMDYuNCw0MzAuNnoNCgkJIE0yMTk1LjMsNTAwLjdWNDQ2aDkuOXY1NC43SDIxOTUuM3oiLz4NCgk8cGF0aCBkPSJNMjI2MC44LDQ5OC43Yy0yLjYsMS40LTguNCwzLjItMTUuNywzLjJjLTE2LjUsMC0yNy4yLTExLjItMjcuMi0yNy45YzAtMTYuOCwxMS41LTI5LDI5LjQtMjljNS45LDAsMTEuMSwxLjUsMTMuOCwyLjgNCgkJbC0yLjMsNy43Yy0yLjQtMS40LTYuMS0yLjYtMTEuNS0yLjZjLTEyLjUsMC0xOS4zLDkuMy0xOS4zLDIwLjdjMCwxMi43LDguMSwyMC41LDE5LDIwLjVjNS43LDAsOS40LTEuNSwxMi4yLTIuN0wyMjYwLjgsNDk4Ljd6Ii8+DQoJPHBhdGggZD0iTTIyNzcuMyw0NzUuMWMwLjIsMTMuNCw4LjgsMTksMTguOCwxOWM3LjEsMCwxMS40LTEuMiwxNS4xLTIuOGwxLjcsNy4xYy0zLjUsMS42LTkuNSwzLjQtMTguMiwzLjQNCgkJYy0xNi44LDAtMjYuOS0xMS4xLTI2LjktMjcuNnM5LjctMjkuNSwyNS43LTI5LjVjMTcuOSwwLDIyLjYsMTUuNywyMi42LDI1LjhjMCwyLTAuMiwzLjYtMC4zLDQuNkgyMjc3LjN6IE0yMzA2LjQsNDY4DQoJCWMwLjEtNi4zLTIuNi0xNi4yLTEzLjgtMTYuMmMtMTAuMSwwLTE0LjUsOS4zLTE1LjMsMTYuMkgyMzA2LjR6Ii8+DQoJPHBhdGggZD0iTTIzMjcsNDkwLjVjMi45LDEuOSw4LjEsNCwxMy4xLDRjNy4yLDAsMTAuNi0zLjYsMTAuNi04LjFjMC00LjctMi44LTcuMy0xMC4yLTEwLjFjLTkuOC0zLjUtMTQuNS04LjktMTQuNS0xNS41DQoJCWMwLTguOCw3LjEtMTYsMTguOS0xNmM1LjUsMCwxMC40LDEuNiwxMy40LDMuNGwtMi41LDcuMmMtMi4xLTEuNC02LjEtMy4yLTExLjItMy4yYy01LjksMC05LjIsMy40LTkuMiw3LjVjMCw0LjUsMy4zLDYuNiwxMC40LDkuMw0KCQljOS41LDMuNiwxNC40LDguNCwxNC40LDE2LjVjMCw5LjYtNy41LDE2LjQtMjAuNSwxNi40Yy02LDAtMTEuNS0xLjUtMTUuNC0zLjdMMjMyNyw0OTAuNXoiLz4NCjwvZz4NCjwvc3ZnPg0K"/></p>
            <p>&nbsp;</p>
            <h3 style="color: #de0027; text-align: center;">Access is not allowed from your IP or your country.</h3>
            <p>If you think it's a mistake, please contact with the websmater of the website.</p>
            <p>If you are the owner of the website, please contact with <a target="_blank" href="https://www.siteguarding.com/en/contacts">SiteGuarding.com support</a></p>
            <h4>Session details:</h4>
            <p>IP: <?php echo $myIP; ?></p>
            <?php
            if ($country_name != '') echo '<p>Country: '.$country_name.'</p>';
            ?>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

            <p style="font-size: 70%;">Powered by <a target="_blank" href="https://www.siteguarding.com/">SiteGuarding.com</a></p>
        </div>
        </body></html>
        <?php
    }

}