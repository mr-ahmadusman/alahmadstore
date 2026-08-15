# Domain Layer

This directory contains the core business logic of the application. It is
independent of Laravel’s framework specifics and can be unit‑tested in
isolation.

Typical contents:

* **Entities** – Plain PHP objects that represent domain concepts.
* **Value Objects** – Immutable objects that encapsulate a value.
* **Repositories** – Interfaces for persisting entities.
* **Services** – Orchestrate complex workflows.

Feel free to add sub‑folders as the domain grows.
