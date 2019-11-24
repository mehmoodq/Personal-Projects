import javax.crypto.Cipher;
import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
import javax.crypto.spec.IvParameterSpec;
import javax.crypto.BadPaddingException;
import java.io.File;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.nio.charset.StandardCharsets;
import java.util.Arrays;
import java.util.Scanner;
import java.security.MessageDigest;
import java.security.SecureRandom;
// BEGIN SOLUTION
import java.security.*;
import javax.crypto.*;
import java.util.*;
// please import only standard libraries and make sure that your code compiles and runs without unhandled exceptions
// END SOLUTION

public class HW2 {
  static void P1() throws Exception {
    byte[] cipherBMP = Files.readAllBytes(Paths.get("cipher1.bmp"));

    // BEGIN SOLUTION
    byte[] ivKey = new byte[] { 0, 0, 0, 0,
                              0, 0, 0, 0,
                              0, 0, 0, 0,
                              0, 0, 0, 0 };
															
		byte[] key = new byte[16];
		
		byte counter = 1;
		
		for(int i = 0; i < 16; i++){
			key[i] = counter;
			counter++;
		}
		
		IvParameterSpec iv = new IvParameterSpec(ivKey);
		SecretKeySpec keySpec = new SecretKeySpec(key, "AES");
		Cipher cipher = Cipher.getInstance("AES/CBC/ISO10126Padding");
		cipher.init(Cipher.DECRYPT_MODE, keySpec, iv);
		byte[] plainBMP = cipher.doFinal(cipherBMP);
    // END SOLUTION

    Files.write(Paths.get("plain1.bmp"), plainBMP);
  }

  static void P2() throws Exception {
    byte[] cipher = Files.readAllBytes(Paths.get("cipher2.bin"));
    // BEGIN SOLUTION
    byte[] modifiedCipher = new byte[48];
		
		for(int i = 0; i < 16; i++){
			modifiedCipher[i] = cipher[i + 32];
		}
		for(int i = 16; i < 32; i++){
			modifiedCipher[i] = cipher[i];
		}
		for(int i = 32; i < modifiedCipher.length; i++){
			modifiedCipher[i] = cipher[i - 32];
		}
		
		byte[] ivKey = new byte[] { 0, 0, 0, 0,
                              0, 0, 0, 0,
                              0, 0, 0, 0,
                              0, 0, 0, 0 };
		byte[] key = new byte[16];
		byte counter = 1;
		
		for(int i = 0; i < 16; i++){
			key[i] = counter;
			counter++;
		}
		
		IvParameterSpec iv = new IvParameterSpec(ivKey);
		SecretKeySpec keySpec = new SecretKeySpec(key, "AES");
		Cipher ciphering = Cipher.getInstance("AES/CBC/NoPadding");
		ciphering.init(Cipher.DECRYPT_MODE, keySpec, iv);
		byte[] plain = ciphering.doFinal(modifiedCipher);
    // END SOLUTION

    Files.write(Paths.get("plain2.txt"), plain);
  }

  static void P3() throws Exception {
    byte[] cipherBMP = Files.readAllBytes(Paths.get("cipher3.bmp"));
    byte[] otherBMP = Files.readAllBytes(Paths.get("plain1.bmp"));
    
    // BEGIN SOLUTION
    byte[] modifiedBMP = cipherBMP;
		for(int i = 0; i < 1000; i++){
			modifiedBMP[i] = otherBMP[i];
		}
    // END SOLUTION
    
    Files.write(Paths.get("cipher3_modified.bmp"), modifiedBMP);
  }

  static void P4() throws Exception {
    byte[] plainA = Files.readAllBytes(Paths.get("plain4A.txt"));
    byte[] cipherA = Files.readAllBytes(Paths.get("cipher4A.bin"));
    byte[] cipherB = Files.readAllBytes(Paths.get("cipher4B.bin"));

    // BEGIN SOLUTION
    byte[] plainB = cipherB;
		byte[] key = new byte[plainA.length];
		
		for(int i = 0; i < key.length; i++){
			key[i] = (byte)(plainA[i] ^ cipherA[i]);
		}
		
		for(int i = 0; i < plainB.length; i++){
			plainB[i] = (byte)(cipherB[i] ^ key[i]);
		}
    // END SOLUTION

    Files.write(Paths.get("plain4B.txt"), plainB);
  }

  static void P5() throws Exception {
    byte[] cipherBMP = Files.readAllBytes(Paths.get("cipher5.bmp"));

    // BEGIN SOLUTION
		byte[] otherBMP = Files.readAllBytes(Paths.get("plain1.bmp"));
    byte[] plainBMP = new byte[cipherBMP.length];
    byte[] ivKey = new byte[] { 0,   0,    0,   0,
                                0,   0,    0,   0,
                                0,   0,    0,   0,
                                0,   0,    0,   0 };
																
		byte[] key = new byte[16];
		for(int i = 0; i < key.length; i++){
			key[i] = 0;
		}
		
		IvParameterSpec iv = new IvParameterSpec(ivKey);
		boolean found = false;
		for(byte i = 0; i < 100; i++){
			if(found)
				break;
			key[0] = i;
			for(byte j = 1; j < 13; j++){
				if(found)
					break;
				key[1] = j;
				for(byte k = 1; k < 32; k++){
					if(found)
						break;
					key[2] = k;
					SecretKeySpec keySpec = new SecretKeySpec(key, "AES");
					Cipher cipher = Cipher.getInstance("AES/CBC/ISO10126Padding");
					cipher.init(Cipher.DECRYPT_MODE, keySpec, iv);
					try{
						plainBMP = cipher.doFinal(cipherBMP);
					}
					catch(BadPaddingException e){
					}
					if(plainBMP[0] == 66 && plainBMP[1] == 77 && plainBMP[2] == otherBMP[2] && plainBMP[3] == otherBMP[3] && plainBMP[4] == otherBMP[4] && plainBMP[5] == otherBMP[5]){
						found = true;
					}
				}
			}
		}
		
    // try {
			//plainBMP = cipherBMP;
      // decryption might throw a BadPaddingException!
    // }
    // catch (BadPaddingException e) {
    // }
    // END SOLUTION

    Files.write(Paths.get("plain5.bmp"), plainBMP);
  }

  public static void main(String [] args) {
    try {
      P1();
      P2();
      P3();
      P4();
      P5();
    } catch (Exception e) {
      e.printStackTrace();
    }
  }
}
