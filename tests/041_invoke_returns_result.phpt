--TEST--
invoke() returns correct result for STFC_STRUCTURE (struture + tables).
--SKIPIF--
<?php include("should_run_online_tests.inc"); ?>
--FILE--
<?php
$config = include "sapnwrfc.config.inc";
$c = new \SAPNWRFC\Connection($config);

$importStruct = [
    'RFCFLOAT' => 1.23456789,
    'RFCCHAR1' => 'A',
    'RFCCHAR2' => 'BC',
    'RFCCHAR4' => 'DEFG',
    'RFCINT1' => 1,
    'RFCINT2' => 2,
    'RFCINT4' => 345,
    'RFCHEX3' => 'fgh',
    'RFCTIME' => '121120',
    'RFCDATE' => '20140101',
    'RFCDATA1' => '1DATA1',
    'RFCDATA2' => 'DATA222',
];

$importTable = [$importStruct];

$params = [
    "IMPORTSTRUCT" => $importStruct,
    "RFCTABLE" => $importTable,
];

$f = $c->getFunction("STFC_STRUCTURE");
$result = $f->invoke($params);

// asserts
var_dump(is_array($result));
var_dump(array_key_exists('ECHOSTRUCT', $result));
var_dump(array_key_exists('RFCTABLE', $result));

var_dump(rtrim($result["ECHOSTRUCT"]["RFCCHAR1"]) == $importStruct["RFCCHAR1"]);
var_dump(rtrim($result["ECHOSTRUCT"]["RFCCHAR2"]) == $importStruct["RFCCHAR2"]);
var_dump(rtrim($result["ECHOSTRUCT"]["RFCCHAR4"]) == $importStruct["RFCCHAR4"]);
var_dump(rtrim($result["ECHOSTRUCT"]["RFCFLOAT"]) == $importStruct["RFCFLOAT"]);
var_dump(rtrim($result["ECHOSTRUCT"]["RFCINT1"]) == $importStruct["RFCINT1"]);
var_dump(rtrim($result["ECHOSTRUCT"]["RFCINT2"]) == $importStruct["RFCINT2"]);
var_dump(rtrim($result["ECHOSTRUCT"]["RFCINT4"]) == $importStruct["RFCINT4"]);
var_dump(rtrim($result["ECHOSTRUCT"]["RFCDATA1"]) == $importStruct["RFCDATA1"]);
var_dump(rtrim($result["ECHOSTRUCT"]["RFCDATA2"]) == $importStruct["RFCDATA2"]);

var_dump(count($result["RFCTABLE"]) == 2);
var_dump(rtrim($result["RFCTABLE"][1]["RFCFLOAT"]) == $importStruct["RFCFLOAT"] + 1);
var_dump(rtrim($result["RFCTABLE"][1]["RFCINT1"]) == $importStruct["RFCINT1"] + 1);
var_dump(rtrim($result["RFCTABLE"][1]["RFCINT2"]) == $importStruct["RFCINT2"] + 1);
var_dump(rtrim($result["RFCTABLE"][1]["RFCINT4"]) == $importStruct["RFCINT4"] + 1);

var_dump(rtrim($result["RFCTABLE"][1]["RFCCHAR1"]) == "X");
//var_dump(rtrim($result["RFCTABLE"][1]["RFCCHAR4"]) == "SYS"); // system name
var_dump(rtrim($result["RFCTABLE"][1]["RFCHEX3"]) == hex2bin("F1F2F3"));
var_dump(rtrim($result["RFCTABLE"][1]["RFCCHAR2"]) == "YZ");
--EXPECT--
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
