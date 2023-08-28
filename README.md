# fake-git-commit-dates
script to fake git commit dates between 2 dates

lets say you have a bunch of commits you want spread out between 14:00 today and 17:00 today:
find the id of the oldest commit, then do
```
php fake_git_commit_dates.php --git_dir='/home/hans/projects/fakeproject' --commit_start=4afad130 --date_start='today 14:00' --date_end='today 17:00'
```
and you should get something like:
```
hans@devad22:~/projects/test$ php fake_git_commit_dates.php --git_dir='/home/hans/projects/fakeproject' --commit_start=4afad130 --date_start='today 14:00' --date_end='today 17:00'
Run the following commands:
GIT_SEQUENCE_EDITOR="sed -i -re 's/^pick /e /'" git rebase -i '4afad130'
GIT_COMMITTER_DATE='2023-08-28T14:00:00+00:00' git commit --amend --no-edit --date='2023-08-28T14:00:00+00:00'
git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T14:25:43+00:00' git commit --amend --no-edit --date='2023-08-28T14:25:43+00:00'
git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T14:51:26+00:00' git commit --amend --no-edit --date='2023-08-28T14:51:26+00:00'
git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T15:17:09+00:00' git commit --amend --no-edit --date='2023-08-28T15:17:09+00:00'
git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T15:42:52+00:00' git commit --amend --no-edit --date='2023-08-28T15:42:52+00:00'
git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T16:08:35+00:00' git commit --amend --no-edit --date='2023-08-28T16:08:35+00:00'
git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T16:34:18+00:00' git commit --amend --no-edit --date='2023-08-28T16:34:18+00:00'
git rebase --continue
press Y to continue
y
GIT_SEQUENCE_EDITOR="sed -i -re 's/^pick /e /'" git rebase -i '4afad130'
Stopped at 1d0f337c0...  FakeObjectFactory FakeController\FakeLeadsStatistics
You can amend the commit now, with

  git commit --amend 

Once you are satisfied with your changes, run

  git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T14:00:00+00:00' git commit --amend --no-edit --date='2023-08-28T14:00:00+00:00'
[detached HEAD 1d0f337c0] FakeObjectFactory FakeController\FakeLeadsStatistics
 Date: Mon Aug 28 14:00:00 2023 +0000
 1 file changed, 13 insertions(+), 11 deletions(-)
git rebase --continue
Stopped at 34c3b5499...  FakeObjectFactory FakeController\FakeAllCustomers
You can amend the commit now, with

  git commit --amend 

Once you are satisfied with your changes, run

  git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T14:25:43+00:00' git commit --amend --no-edit --date='2023-08-28T14:25:43+00:00'
[detached HEAD 34c3b5499] FakeObjectFactory FakeController\FakeAllCustomers
 Date: Mon Aug 28 14:25:43 2023 +0000
 2 files changed, 153 insertions(+), 49 deletions(-)
git rebase --continue
Stopped at 6cc21527c...  FakeObjectFactory FakeController\FakeCustomerAccounts
You can amend the commit now, with

  git commit --amend 

Once you are satisfied with your changes, run

  git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T14:51:26+00:00' git commit --amend --no-edit --date='2023-08-28T14:51:26+00:00'
[detached HEAD 6cc21527c] FakeObjectFactory FakeController\FakeCustomerAccounts
 Date: Mon Aug 28 14:51:26 2023 +0000
 1 file changed, 11 insertions(+), 16 deletions(-)
git rebase --continue
Stopped at 80352f820...  FakeObjectFactory FakeController\FakeGroups
You can amend the commit now, with

  git commit --amend 

Once you are satisfied with your changes, run

  git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T15:17:09+00:00' git commit --amend --no-edit --date='2023-08-28T15:17:09+00:00'
[detached HEAD 80352f820] FakeObjectFactory FakeController\FakeGroups
 Date: Mon Aug 28 15:17:09 2023 +0000
 2 files changed, 44 insertions(+), 15 deletions(-)
git rebase --continue
Stopped at da01b19f1...  FakeObjectFactory FakeController\FakeInvoice
You can amend the commit now, with

  git commit --amend 

Once you are satisfied with your changes, run

  git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T15:42:52+00:00' git commit --amend --no-edit --date='2023-08-28T15:42:52+00:00'
[detached HEAD da01b19f1] FakeObjectFactory FakeController\FakeInvoice
 Date: Mon Aug 28 15:42:52 2023 +0000
 1 file changed, 12 insertions(+), 13 deletions(-)
git rebase --continue
Stopped at 3a16da2a8...  FakeObjectFactory FakeController\FakeOrders
You can amend the commit now, with

  git commit --amend 

Once you are satisfied with your changes, run

  git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T16:08:35+00:00' git commit --amend --no-edit --date='2023-08-28T16:08:35+00:00'
[detached HEAD 3a16da2a8] FakeObjectFactory FakeController\FakeOrders
 Date: Mon Aug 28 16:08:35 2023 +0000
 1 file changed, 14 insertions(+), 18 deletions(-)
git rebase --continue
Stopped at 2df15f6cf...  update tests
You can amend the commit now, with

  git commit --amend 

Once you are satisfied with your changes, run

  git rebase --continue
GIT_COMMITTER_DATE='2023-08-28T16:34:18+00:00' git commit --amend --no-edit --date='2023-08-28T16:34:18+00:00'
[detached HEAD 2df15f6cf] update tests
 Date: Mon Aug 28 16:34:18 2023 +0000
 2 files changed, 11 insertions(+), 2 deletions(-)
git rebase --continue
Successfully rebased and updated refs/heads/factory-rollout4.
```

and on the git log, those commits are now spread out between those 2 dates (-: Lets hope you never have to use it.
