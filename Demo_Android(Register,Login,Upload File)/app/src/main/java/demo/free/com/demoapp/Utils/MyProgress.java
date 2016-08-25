package demo.free.com.demoapp.Utils;

/**
 * Created by Rajarajan on 2/15/2016.
 */
import android.app.ProgressDialog;
import android.content.Context;

public class MyProgress {
    public static ProgressDialog pDialog;

    public MyProgress(Context ctx, String message)
    {
        pDialog = new ProgressDialog(ctx);
        pDialog.setMessage(message);
        pDialog.setCancelable(false);

    }
    public void hideProgress() {
        // TODO Auto-generated method stub
        if(pDialog.isShowing())
            pDialog.dismiss();
    }

    public void showProgress() {
        // TODO Auto-generated method stub

        if(!pDialog.isShowing())
            pDialog.show();

    }
}
