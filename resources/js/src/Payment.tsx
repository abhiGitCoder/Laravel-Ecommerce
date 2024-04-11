import React, { useEffect, useState } from "react";
import "../../css/pay.css";
import { useLocation } from "react-router-dom";
import axios from "axios";
import { useNavigate } from "react-router-dom";
import "../../css/detail.css";
import Navbar from "./Navbar";

export default function Payment() {
  const location = useLocation();
  const total = location.state;
  const [userData, setUserData] = useState([]);
  const navigate = useNavigate();

  const cancelDelivery = async () => {
    try {
      const result = await axios.delete("http://localhost/api/deliverycancel", {
        params: {
          email: userData.email,
        },
      });
    } catch (error) {
      console.log(error);
    }
  };

  const handlePaymentSuccess = async (paymentId) => {
    try {
 const deliveryResponse = await axios.post("http://localhost/api/deliverystore", {
        email: userData.email,
      });
      for (const item of deliveryResponse.data.data) {
        const update = await axios.put("http://localhost/api/stock", {
          product_id: item.product_id,
          qty: item.qty,
        });
      }

      const purchase = await axios.delete(
                 "http://localhost/api/afterpurchase",
                    {
                        params: {
                            email: userData.email,
                        },
                    }
                );

                await cancelDelivery();

      navigate("/confirmation");
    } catch (error) {
      console.log(error);
    }
  };



  const confirmation = async () => {
    try {
      const Api = await axios.post("http://localhost/api/makeOrder", {
        amount: total,
      });

      var options = {
        key: "rzp_test_dMX2gwFb2uYdVE",
        amount: total * 100,
        currency: "INR",
        name: "Ecommerce website",
        description: "Thank you for Shopping",
        order_id: Api.orderId,
        handler: function (response) {
          const paymentId = response.razorpay_payment_id;
          if (paymentId) {
            handlePaymentSuccess(paymentId);
         }
        
        },
        prefill: {
          name: userData.name,
          email: userData.email,
        },
        notes: {
          address: "Razorpay Corporate Office",
        },
        theme: {
          color: "#3399cc",
        },
      };

      var rzp1 = new Razorpay(options);
      rzp1.open();
    } catch (error) {
      console.log(error);
    }
  };

  const cancel = async () => {
    try {
      await cancelDelivery();
      navigate("/cancel");
    } catch (error) {
      console.log(error);
    }
  };

  useEffect(() => {
    const fetchData = () => {
      const storedData = localStorage.getItem("user-info");
      if (storedData) {
        const parsedData = JSON.parse(storedData);
        setUserData(parsedData.customer[0]);
      }
    };
    fetchData();
  }, []);

  return (
    <>
      <Navbar />
      <div className="pay-container">
        <br />
        <p>Total: {total}</p>
        <br />
        <button onClick={confirmation}>Pay Now</button>
        <br />
        <br />
        <button onClick={cancel}>Cancel</button>
      </div>
    </>
  );
}
