```mermaid
erDiagram

users {
    id
    user_name
    email
    password
    created_at
    updated_at
}

products {
    id
    company_id
    product_name
    price
    stock
    comment
    img_path
    created_at
    updated_at
}

sales {
    id
    product_id
    created_at
    updated_at
}

companies {
    id
    company_name
    street_address
    representative_name
    created_at
    updated_at
}
```