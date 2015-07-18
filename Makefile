DEFAULT_GOAL := all
.PHONY: $(DEFAULT_GOAL)
$(DEFAULT_GOAL):
	php -d open_basedir=NULL generate.php
	cp -R assets out/

clean:
	rm -Rf out

watch:
	while inotifywait -r -e modify,move,create,delete templates; do $(MAKE); done

run:
	cd out && php -d open_basedir=NULL -S localhost:8888
