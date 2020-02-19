### 0.1.0-beta.5

**You'll lose all of your previous revisions.**

- **Reduce** storage volume
  + It's now almost 1.5x less than 0.1.0-beta.4 ([click here for sample comparison](https://www.diffchecker.com/hWRMcRDB))
- **Add** delete revisions feature.
  + Christmas came early. Do not forget to set permissions.
- **Add** interchangeable detail level feature.
  + You can immediately change the views of the diffs from one level to another without worrying about previous diffs which were calculated before.
- **Update** renderer views & layouts.
  + I loved the [rtfpessoa/diff2html](https://github.com/rtfpessoa/diff2html) library's layout and decided to implement it.
- **Fix** pluralization for `forum.revisionInfo` key (thanks to @rob006)
- **Update** README.md

### 0.1.0-beta.4

- **Fix** users always gets "PermissionDeniedException" when redrawing the post.
- **Fix** table headings are missing.
- **Fix** typos in translation keys (seperate -> separate).
- **Update** `php-diff` library to 6.4.4

### 0.1.0-beta.3

- **Update** directory structure.

### 0.1.0-beta.2

- **Fix** diff list is not showing up immediately after clicking the "Edited" button.
- **Fix** diff list is not showing up on `[deleted]` user's post.
- **Add** store diffs in `app.cache` on "Edited" button's `click` event.
- **Add** `fof/nightmode` support.
- **Update** dependencies.

### 0.1.0-beta.1

Initial release (as WIP).
