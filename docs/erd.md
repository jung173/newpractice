```mermaid
erDiagram
    users {
        PK id : int
        name : string
        email : string
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