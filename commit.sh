#!/bin/bash
# Script to automate git commit process and pushing to both github/justinbaur
# and heroku.  Then deploying to heroku
echo "Adding updates to Git"
git add .
comment=
echo -n "Requesting Commit Comment.. [$comment] >"
read comment
if [ -n "$comment"]; then
	comment=$comment
fi
git commit -m comment
git push


