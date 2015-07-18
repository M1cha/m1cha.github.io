DEFAULT_GOAL := all
.PHONY: $(DEFAULT_GOAL)
$(DEFAULT_GOAL):
	php -d open_basedir=NULL generate.php

clean:
	rm -Rf projects index.html
