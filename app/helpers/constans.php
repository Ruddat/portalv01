<?php

class constGuards
{
    const ADMIN = 'admin';
    const SELLER = 'seller';
    const CLIENT = 'client';
    const BROKER = 'broker';
}

class constDefaults
{
    const tokenExpiredMinutes = 15;
    const sellerTokenExpiredMinutes = 30;
    const brokerTokenExpiredMinutes = 30;
}
