package r.ep.spletna_trgovina;

/**
 * Created by Simona on 20. 01. 2018.
 */

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.CollapsingToolbarLayout;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;
import java.io.IOException;

import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class ItemDetailActivity extends AppCompatActivity implements Callback<Item> {
    private static final String TAG = ItemDetailActivity.class.getCanonicalName();

    private Item item;
    private TextView tvItemDetail;
    private CollapsingToolbarLayout toolbarLayout;
    private FloatingActionButton fabEdit, fabDelete;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_item_detail);
            final Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
            setSupportActionBar(toolbar);

            toolbarLayout = (CollapsingToolbarLayout) findViewById(R.id.toolbar_layout);

            tvItemDetail = (TextView) findViewById(R.id.tv_item_detail);

            getSupportActionBar().setDisplayHomeAsUpEnabled(true);

            final int id = getIntent().getIntExtra("r.ep.spletna_trgovina.id", 0);

            Log.d("Test test", "Id" + id);

            if (id > 0) {
                ItemService.getInstance().get(id).enqueue(this);
            }
    }

    @Override
    public void onResponse(Call<Item> call, Response<Item> response) {
            item = response.body();
            Log.i(TAG, "Got result: " + item);

            //final List<Item> hits = response.body();
            if (response.isSuccessful()) {
                //Log.i(TAG, "Hits:" + hits.size());
                /*for (Item item : hits) {
                    Log.d("Item", "Item id: " + item.id);
                }*/
                tvItemDetail.setText(item.description);
                toolbarLayout.setTitle(item.name);

            } else {
                String errorMessage;
                try {
                    errorMessage = "An error occurred: " + response.errorBody().string();
                } catch (IOException e) {
                    errorMessage = "An error occurred: error while decoding the error message.";
                }
                Log.e(TAG, errorMessage);
                tvItemDetail.setText(errorMessage);
            }
    }

    @Override
    public void onFailure(Call<Item> call, Throwable t) {
            Log.w(TAG, "Error: " + t.getMessage(), t);
    }
}
