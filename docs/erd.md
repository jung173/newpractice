```mermaid
erDiagram

users {
    id PK
    user_name
    email
    password
    created_at
    updated_at
}

products {
    id PK
    company_id FK
    product_name
    price
    stock
    comment
    img_path
    created_at
    updated_at
}

sales {
    id PK
    product_id FK
    user_id FK
    created_at
    updated_at
}

companies {
    id PK
    company_name
    street_address
    representative_name
    created_at
    updated_at
}
```