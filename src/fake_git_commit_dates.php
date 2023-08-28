#!/usr/bin/env php
<?php

declare(strict_types=1);

use function var_dump as d;
// GIT_SEQUENCE_EDITOR="sed -i -re 's/^pick /e /'" git rebase -i 4afad130
$args_raw = $argv;
unset($args_raw[0]);
$args_parsed = [
    'git_dir' => null,
    'commit_start' => null,
    'date_start' => null,
    'date_end' => null,
];
$usage_string = 'Usage: php fake_git_commit_dates.php --git_dir=/path/to/gitdir --commit_start=<commit> --date_start=<date> --date_end=<date>' . PHP_EOL;
foreach ($args_raw as $arg_raw) {
    $arg = $arg_raw;
    $arg = substr($arg, 2);
    $arg = explode('=', $arg);
    if (count($arg) === 2) {
        $arg_name = $arg[0];
        $arg_value = $arg[1];
        if ($arg_name === 'commit_start' || $arg_name === 'git_dir') {
            $args_parsed[$arg_name] = $arg_value;
            continue;
        }
        if ($arg_name === 'date_start' || $arg_name === 'date_end') {
            $success = null;
            try {
                $arg_value = new DateTimeImmutable($arg_value);
                $success = true;
            } catch (Throwable $e) {
                $success = false;
            }
            if ($success) {
                $args_parsed[$arg_name] = $arg_value;
                continue;
            }
        }
    }
    $str = 'Error: Invalid argument: ' . $arg_raw . PHP_EOL;
    $str .= $usage_string;
    fwrite(STDERR, $str);
    exit(1);
}
foreach ($args_parsed as $arg_name => $arg_value) {
    if ($arg_value === null) {
        $str = 'Error: Missing argument: --' . $arg_name . PHP_EOL;
        $str .= $usage_string . PHP_EOL;
        fwrite(STDERR, $str);
        exit(1);
    }
}
chdir($args_parsed['git_dir']);
$start_date = $args_parsed['date_start'];
$end_date = $args_parsed['date_end'];
$commit_start = $args_parsed['commit_start'];
// first find out how many commits we have
$cmd = 'git rev-list --count ' . escapeshellarg($commit_start) . '..HEAD';
$commits_count = (int) shell_exec($cmd);
// seconds between start and end date
$seconds_diff = $end_date->getTimestamp() - $start_date->getTimestamp();
// seconds per commit
$seconds_per_commit = $seconds_diff / $commits_count;
$seconds_per_commit = (int) round($seconds_per_commit, 0, PHP_ROUND_HALF_DOWN); // DateTimeImmutable::modify() has bugs with float: https://3v4l.org/SNvlh
$fakeDate = clone ($start_date);
// GIT_SEQUENCE_EDITOR="sed -i -re 's/^pick /e /'" git rebase -i 4afad130
$cmds = [];
$cmds[] = 'GIT_SEQUENCE_EDITOR="sed -i -re \'s/^pick /e /\'" git rebase -i ' . escapeshellarg($commit_start);
for ($i = 0; $i < $commits_count; ++$i) {
    // GIT_COMMITTER_DATE="2017-10-08T09:51:07" git commit --amend --date="2017-10-08T09:51:07"
    $cmds[] = 'GIT_COMMITTER_DATE=' . escapeshellarg($fakeDate->format(DateTime::RFC3339)) . ' git commit --amend --no-edit --date=' . escapeshellarg($fakeDate->format(DateTime::RFC3339));
    $fakeDate = $fakeDate->modify('+' . $seconds_per_commit . ' seconds');
    $cmds[] = 'git rebase --continue';
}
echo "Run the following commands:" . PHP_EOL;
echo implode(PHP_EOL, $cmds) . PHP_EOL;
echo "press Y to continue" . PHP_EOL;
if (strtoupper(trim(fgets(STDIN))) !== 'Y') {
    echo "Aborting" . PHP_EOL;
    exit(1);
}
foreach ($cmds as $cmd) {
    echo $cmd . PHP_EOL;
    passthru($cmd);
}
