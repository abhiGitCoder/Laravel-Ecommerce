import React, { useState } from "react";
import { createRoot } from "react-dom/client";
import { BrowserRouter,HashRouter,Route, Routes } from "react-router-dom";
import Login from "./src/Login";
import Register from "./src/Register";
import Orderhistory from "./src/Orderhistory";
import AddtoCart from "./src/AddtoCart";
import Home from "./src/Home";
import Confirmation from "./src/Confirmation";
import Cancel from "./src/Cancel";
import ProductDetails from "./src/ProductDetails";
import Payment from "./src/Payment";

function Exam() {
    return (
        <div>
            <HashRouter>
                
                <Routes>
                    <Route path="/" element={<Home />} />
                    <Route path="/login" element={<Login />} />
                    <Route path="/register" element={<Register />} />
                    <Route path="/cart" element={<AddtoCart />} />
                    <Route path="/confirmation" element={<Confirmation />} />
                    <Route path="/cancel" element={<Cancel />} />
                    <Route path="/order" element={<Orderhistory />} />
                    <Route path="/pay" element={<Payment />} />
                    <Route path="/product/:id" element={<ProductDetails />} /> 
                </Routes>
                </HashRouter>
        </div>
    );
}

const root = createRoot(document.getElementById("app"));
root.render(<Exam />);
