--TEST--
setIniPath() does only accept a string parameter.
--SKIPIF--
<?php include("skipif.inc"); ?>
--FILE--
<?php

function test($param) {
    try {
        \SAPNWRFC\Connection::setIniPath($param);
        echo "ok\n";
    } catch(\SAPNWRFC\ConnectionException $e) {
        echo "fail\n";
    }
}

test('.');
test([]);
test(new \stdClass);
--EXPECT--
ok
fail
fail