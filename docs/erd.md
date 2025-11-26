```mermaid
erDiagram

users {
    id
    username
    email
    password
    createdat
    updatedat
}

products {
    id
    companyid
    productname
    price
    stock
    comment
    img_path
    createdat
    updatedat
}

sales {
    id
    productid
    createdat
    updatedat
}

companies {
    id
    companyname
    streetaddress
    representativename
    createdat
    updatedat
}
```