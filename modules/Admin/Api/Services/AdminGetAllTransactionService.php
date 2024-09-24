<?php

namespace App\Modules\Admin\Api\Services;


// use App\Models\Transaction;




// use App\Modules\Services\PaymentService;

use App\Modules\Admin\Api\Repositories\AdminGetAllTransactionsRepository;
use App\Modules\Admin\Api\Requests\BannedUserRequest;
use App\Modules\Wallet\Models\CryptoAssetRate;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminGetAllTransactionService
{

    protected $transactions;
    protected $bankSearch;

  


    public function __construct()
    { // $data = CryptoAssetRate::findOrFail($id);

        // $data->update($request);

        // return $data;
        $this->transactions = app(AdminGetAllTransactionsRepository::class);
        // $this->bankSearch = app(BankListRepository::class);

    }

    /**
 * Create a new blog post.
 *
 * @throws \Illuminate\Auth\Access\AuthorizationException
 */

    public function getUserExpenseTransactions(){

        return $this->transactions->getUserExpenseTransactions();

    }

    public function getSingleExpenseTransaction($transactionId){
        
        return $this->transactions->getSingleExpenseTransaction($transactionId);
    }


 

    public function getUserCryptoSellTransactions(){

        return $this->transactions->getUserSellCryptoTransactions();

    }

    public function getSingleCryptoTransaction($transactionId){ 

        return $this->transactions->getSingleCryptoTransaction($transactionId);
        
    }



    // getUserSellGiftcardTransactions


    public function getUserSellGiftcardTransactions(){

        return $this->transactions->getUserSellGiftcardTransactions();

    }


    public function getSingleGiftcardTransaction($transactionId){ 

        return $this->transactions->getSingleGiftcardTransaction($transactionId);
        
    }






    public function updateCryptoStatus($request, $id){


        $data = $request['status'];

        return $this->transactions->updateCryptoStatus($data, $id);
    
    }



    public function updateGiftcardStatus($request, $id){


        $data = $request['status'];
        $message = $request['message'] ?? null;

        return $this->transactions->updateGiftcardStatus($data, $message, $id);

    }



    public function declinedCrypto($request, $id){

        $request->validate([

            'message' => 'required',
            'image' => 'required',

        ]);


        $image = $request['image'];
        $message = $request['message'];

        return $this->transactions->declinedCrypto($request, $image, $id);

    }


    public function declinedGiftCard($request, $id)
    {
        

        $request->validate([

            'message' => 'required',
            'image' => 'required',

        ]);


        // $image = $request->file('image');

        // $uploadedImage = Cloudinary::upload($image->getPathname(), [
        //     "folder" => "uploads", // Optional: Set a folder for the image
        // ]);
    
        // // Get the public URL of the uploaded image
        // $imageUrl = $uploadedImage->getSecurePath();

        $image = $request['image'];
        $message = $request['message'];

        return $this->transactions->declinedGiftCard($image, $message, $id);

    }



    public function getUserTransactions(){

        $transactions = $this->transactions->getUserTransactions();

        return $transactions;

    }




    public function getTransactionsWithCategories($status)
    {
       return $allTransactions = $this->transactions->getTransactionsWithCategories($status);

        //  return response()->json([
        //     'transactions' => $allTransactions,
        // ]);
    }



    public function TransactionsWithTransactiontype(){
       return $allTransactions = $this->transactions->transactionsWithTransactiontype();

    }


    public function getP2P(){

        return $allTransactions = $this->transactions->getP2P();
    }


    public function getSingleP2P($id){
        return $allTransactions = $this->transactions->getSingleP2P($id);
    }


    public function getSuccessFullGiftcardTransaction()
    {

    }
        
        
        
    public function getSuccessFullCryptoTransaction()
    {
        return $allTransactions = $this->transactions->getSuccessFullCryptoTransaction();

    }




    public function createCryptoAddressAndRate($request)
    {
        $data = [
            'cryptoAsset_id' => $request['cryptoAsset_id'],
            'selling_rate' => $request['selling_rate'],
            'buying_rate' => $request['buying_rate'],
            'cryptoAddress' => $request['cryptoAddress']
        ];

        return $this->transactions->createCryptoAddressAndRate($data);
        
    }


    public function upDateCryptoAddressAndRate($request, $id)
    {
        // dd($request['crypto_address']);
        // dd($request);


        $data = [
            'selling_rate' => $request['selling_rate'],
            'buying_rate' => $request['buying_rate'],
            'cryptoAddress' => $request['cryptoAddress'],
        ];

        return $this->transactions->updateCryptoAddressAndRate($data, $id);
    }


    

    public function upDateCryptoRate($request, $id){
        return $allTransactions = $this->transactions->upDateCryptoRate($request, $id);
    }





    public function upDateGiftCardRate($request, $id){
        // dd($request);
        return $allTransactions = $this->transactions->upDateGiftCardRate($request, $id);
    }




    public function searchQuery($request)
    {
        // dd($request['referenceNumber']);
        $transactions = $this->transactions->searchQuery($request);

        return response()->json([
            'reference' => $transactions
        ]);
    }


    public function getTotalBalanceInSystem()
    {
        $transactions = $this->transactions->getTotalBalanceInSystem();

        return response()->json([
            'totalBalance' => $transactions
        ]);
    }



}
