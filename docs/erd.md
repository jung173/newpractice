```mermaid
erDiagram
    users {
        PK id 
        user_name
        email
        password
        created_at
        updated_at
    }

    products {
        int id PK
    }

    sales {
        int id PK
    }

    companies {
        int id PK
    }
```