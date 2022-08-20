import axios from 'axios';
import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import { useParams } from 'react-router-dom';
import { PulseLoader } from 'react-spinners';
import swal from 'sweetalert';
import Error from '../Error/Error';
import Footer from '../Footer/Footer';
import Header from '../Header/Header';
import AdminSidebar from './AdminSidebar';

const ServiceProviderDeliveryList = () => {
    const { id } = useParams();
    const [loading, setLoading] = useState(false);
    useEffect(() => {
        setLoading(true);
        setTimeout(() => {
            setLoading(false);
        }, 1000);
    }, []);

    const [deliveryList, setDeliveryList] = useState([]);
    useEffect(() => {
        axios.get(`/api/serviceProviderDeliveries/${id}`).then(response => {
            if (response.data.error) {
                swal("Warning", "Invalid Token!", "error");
            } else {
                console.log(response.data);
                setDeliveryList(response.data);
            }
        })
    }, [id]);

    //delete
    const deleteDelivery = async (event, id) => {
        const response = await axios.delete(`/api/deleteDelivery/${id}`);
        if (response.data.status === 'success') {
            window.location.reload(false);
            swal("Success", response.data.message, "success");
        }
    };

    return (
        <section>
            <Header></Header>
            {
                localStorage.getItem('role') === 'admin' ?
                    <div>
                        <div className="row">
                            <AdminSidebar></AdminSidebar>
                            <div className="col-9">
                                <h3 className="mt-5 fw-bold text-danger">Service Provider Id {id}'s all deliveries</h3>
                                {
                                    loading ?
                                        (
                                            <div className="loading-bg">
                                                <div className="d-flex justify-content-center align-items-center text-center" >
                                                    <div className="">
                                                        <div className="">
                                                            <h5 className="fw-bold text-uppercase" style={{ color: "red" }}>
                                                                <span><span className="mx-2">Loading</span>
                                                                    <PulseLoader className="App" size={10} color={"red"} loading={loading} />
                                                                    <PulseLoader className="App" size={10} color={"red"} loading={loading} />
                                                                </span>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ) :

                                        (
                                            <div>
                                                <table className="table table-striped table-hover">
                                                    <thead className="bg-dark text-white text-center">
                                                        <tr >
                                                        <th>Delivery Id</th>
                                                            <th>Product Name</th>
                                                            <th>Address</th>
                                                            <th>Status</th>
                                                            <th>Comment</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    {
                                                        deliveryList.map(deliveries =>
                                                            <tbody className="text-center">
                                                                <tr>
                                                                <td>{deliveries.id}</td>
                                                                    <td>{deliveries.productName}</td>
                                                                    <td>{deliveries.Address}</td>
                                                                    <td>{deliveries.status}</td>
                                                                    <td>{deliveries.comment}</td>
                                                                   
                                                                    <td >
                                                                        <button className=" btn btn-sm btn-danger mx-1" onClick={(event) => deleteDelivery(event, deliveries.id)}>Delete</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        )
                                                    }
                                                </table>
                                            </div>
                                        )
                                }
                                <Link className='btn btn-success px-3 btn-sm' to="/serviceProviderList">Back</Link>
                            </div>
                        </div>
                    </div>
                    :
                    <Error></Error>
            }
            <Footer></Footer>
        </section>
    );
};

export default ServiceProviderDeliveryList;