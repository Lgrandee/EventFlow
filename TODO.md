# TODO

- [x] Step 1: Fix `routes/web.php` (remove duplicates, correct auth-group nesting/braces, ensure route names/methods exist)

- [x] Step 2: Fix `EventController` (implement/align missing methods referenced by routes; fix `userEvents` relationship; validate & map fields like `date` vs `start_time`; fix redirects to real route names)

- [x] Step 3: Fix `RegistrationController@destroy` authorization (only allow user to delete own registration; avoid guessing)

- [ ] Step 4: Fix schema/model integrity (registrations constraints, field name alignment)

- [ ] Step 5: Fix model issues (e.g. `User` relationship; `Category` fillable redundancy; ensure fillable/casts/relations consistent)

- [ ] Step 6: Run migrations/tests and do quick sanity checks

