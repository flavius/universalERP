# Before executing any of the other scripts, run:
#   `source activate.sh`

t1=$(dirname "${0}")
t2=$(pwd -L)
BASEDIR=$(realpath "${t2}/${t1}")
PATHEXT=$BASEDIR/bin:$BASEDIR/vendor/bin

export OLDPATH=$PATH
export PATH=$PATH:$PATHEXT
