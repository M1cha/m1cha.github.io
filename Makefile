DEFAULT_GOAL := all
.PHONY: $(DEFAULT_GOAL)
$(DEFAULT_GOAL):
	php -d open_basedir=NULL generate.php
	cp -R assets out/
	@find assets/css -name "*.scss" | \
		while read file; do \
		  rm "out/$$file" ; \
		  sass -C --sourcemap=none "$$file" "out/$${file%.scss}.css" ; \
		done

	cp -R uploads out/
	cp CNAME out/
	cp robots.txt out/

clean:
	rm -Rf out

watch:
	while inotifywait -r -e modify,move,create,delete templates assets data.json; do $(MAKE); done

run:
	cd out && php -d open_basedir=NULL -S localhost:8888

publish:
	# fetch repository
	rm -Rf out/git
	mkdir out/git
	cd out/git && \
		git init && \
		git remote add origin $$(git -C ../../ config --get remote.origin.url) && \
		git fetch origin master && \
		git checkout FETCH_HEAD
	
	# copy git directory
	rm -Rf out/.git
	cp -R out/git/.git out
	rm -Rf out/git
	
	# add all files, commit and push
	cd out && \
		git add --all && \
		git commit -m "Update from: $$(git -C .. log --oneline  -1)" && \
		git push origin HEAD:master
