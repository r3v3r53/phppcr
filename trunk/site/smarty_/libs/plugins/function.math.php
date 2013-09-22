ES
--------

An example directly producing formatted text.  Show the most recent
3 tagged commits::

------------
#!/bin/sh

git for-each-ref --count=3 --sort='-*authordate' \
--format='From: %(*authorname) %(*authoremail)
Subject: %(*subject)
Date: %(*authordate)
Ref: %(*refname)

%(*body)
' 'refs/tags'
------------


A simple example showing the use of shell eval on the output,
demonstrating the use of --shell.  List the prefixes of all heads::
------------
#!/bin/sh

git for-each-ref --shell --format="ref=%(refname)" refs/heads | \
while read entry
do
	eval "$entry"
	echo `dirname $ref`
done
------------


A bit more elaborate report on tags, demonstrating that the format
may be an entire script::
------------
#!/bin/sh

fmt='
	r=%(refname)
	t=%(*objecttype)
	T=${r#refs/tags/}

	o=%(*objectname)
	n=%(*authorname)
	e=%(*authoremail)
	s=%(*subject)
	d=%(*authordate)
	b=%(*body)

	kind=Tag
	if test "z$t" = z
	then
		# could be a lightweight tag
		t=%(objecttype)
		kind="Lightweight tag"
		o=%(objectname)
		n=%(authorname)
		e=%(authoremail)
		s=%(subject)
		d=%(authordate)
		b=%(body)
	fi
	echo "$kind $T points at a $t object $o"
	if test "z$t" = zcommit
	then
		echo "The commit was authored by $n $e
at $d, and titled

    $s

Its message reads as:
"
		echo "$b" | sed -e "s/^/    /"
		echo
	fi
'

eval=`git for-each-ref --shell --format="$fmt" \
	--sort='*objecttype' \
	--sort=-taggerdate \
	refs/tags`
eval "$eval"
------------
zA-Z][a-zA-Z0-9_]*)!",$equation, $match);

    foreach($match[1] as $curr_var) {
        if ($curr_var && !isset($params[$curr_var]) && !isset($_allowed_funcs[$curr_var])) {
            trigger_error("math: function call $curr_var not allowed",E_USER_WARNING);
            return;
        }
    }

    foreach($params as $key => $val) {
        if ($key != "equation" && $key != "format" && $key != "assign") {
            // make sure value is not empty
            if (strlen($val)==0) {
                trigger_error("math: parameter $key is empty",E_USER_WARNING);
                return;
            }
            if (!is_numeric($val)) {
                trigger_error("math: parameter $key: is not numeric",E_USER_WARNING);
                return;
            }
            $equation = preg_replace("/\b$key\b/", " \$params['$key'] ", $equation);
        }
    }
    $smarty_math_result = null;
    eval("\$smarty_math_result = ".$equation.";");

    if (empty($params['format'])) {
        if (empty($params['assign'])) {
            return $smarty_math_result;
        } else {
            $template->assign($params['assign'],$smarty_math_result);
        }
    } else {
        if (empty($params['assign'])){
            printf($params['format'],$smarty_math_result);
        } else {
            $template->assign($params['assign'],sprintf($params['format'],$smarty_math_result));
        }
    }
}

?>