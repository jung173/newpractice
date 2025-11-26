```mermaid
erDiagram

    users {
        int id PK
        string user_name
        string email
        string password
        datetime created_at
        datetime updated_at
    }
```